<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use League\Flysystem\AzureBlobStorage\AzureBlobStorageAdapter;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use Illuminate\Support\Facades\Storage;

class AzureBlobStorageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register the Azure service in the container
        $this->app->singleton('azure', function ($app) {
            $config = $app['config']['filesystems.disks.azure'];

            // Create the connection string from config values
            $connectionString = sprintf(
                "DefaultEndpointsProtocol=https;AccountName=%s;AccountKey=%s;EndpointSuffix=core.windows.net",
                $config['name'],
                $config['key']
            );

            $blobClient = BlobRestProxy::createBlobService($connectionString);

            // Create the adapter with the container and blob client
            return new AzureBlobStorageAdapter($blobClient, $config['container']);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Extend the Storage facade to use the Azure Blob Storage adapter
        Storage::extend('azure', function ($app, $config) {
            // Create the connection string from config values
            $connectionString = sprintf(
                "DefaultEndpointsProtocol=https;AccountName=%s;AccountKey=%s;EndpointSuffix=core.windows.net",
                $config['name'],
                $config['key']
            );

            $blobClient = BlobRestProxy::createBlobService($connectionString);

            // Create a Flysystem instance with AzureBlobStorageAdapter
            return new \League\Flysystem\Filesystem(
                new AzureBlobStorageAdapter($blobClient, $config['container'])
            );
        });
    }
}
