<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connectors\PostgresConnector;
use PDO;

class NeonServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Override the PostgresConnector to inject the Neon endpoint ID
        $this->app->bind('db.connector.pgsql', function () {
            return new class extends PostgresConnector {
                public function connect(array $config)
                {
                    $dsn = $this->getDsn($config);

                    // Append Neon endpoint option to DSN if host contains neon.tech
                    $host = $config['host'] ?? '';
                    if (str_contains($host, 'neon.tech')) {
                        $endpointId = explode('.', $host)[0];
                        $dsn .= ";options='endpoint={$endpointId}'";
                    }

                    $options = $this->getOptions($config);

                    $connection = $this->createConnection($dsn, $config, $options);

                    $this->configureIsolationLevel($connection, $config);
                    $this->configureTimezone($connection, $config);
                    $this->configureSearchPath($connection, $config);
                    $this->configureSynchronousCommit($connection, $config);

                    return $connection;
                }
            };
        });
    }

    public function boot(): void
    {
        //
    }
}
