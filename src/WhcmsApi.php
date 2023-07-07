<?php

namespace WhcmsApi;

class WhcmsApi{

    public function boot()
    {
        // Publicar archivos de configuración
        $this->publishConfig();
    }

    public function getclient(){
        return $this->getclientAsync();
    }

    public function getclientAsync(){
        return 'holi';
    }

    protected function publishConfig()
    {
        $configSourcePath = __DIR__ . '/../../config/config.php';
        $configDestinationPath = config_path('whcms.php');
        copy($configSourcePath, $configDestinationPath);
    }
}
