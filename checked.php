<?php


class Update
{
    /**
     * @var string[][]
     */
    public $packages = [
        [
            'name'    => 'sajya/server',
            'version' => '2.0.0.0',
        ],
        [
            'name'    => 'orchid/experiment',
            'version' => '2.3.0.0',
        ],
        [
            'name'    => 'orchid/platform',
            'version' => '9.14.0.0',
        ],
        [
            'name'    => 'orchid/blade-icons',
            'version' => '1.0.0.0',
        ],
        [
            'name'    => 'tabuna/breadcrumbs',
            'version' => '2.0.0.0',
        ],
        [
            'name'    => 'nakukryskin/orchid-repeater-field',
            'version' => '3.0.1.0',
        ],
        [
            'name'    => 'watson/active',
            'version' => '5.0.0.0',
        ],
        [
            'name'    => 'laravel/ui',
            'version' => '3.2.0.0',
        ],
        [
            'name'    => 'orchid/crud',
            'version' => '2.3.0.0',
        ],
        [
            'name'    => 'sti3bas/laravel-scout-array-driver',
            'version' => '2.2.0.0',
        ],
    ];

    public function check()
    {
        $url = 'https://packagist.org/downloads/';

        $packages = [];

        for ($i = 0, $max = random_int(0, 20); $i < $max; $i++) {
            $packages = array_merge($packages, $this->packages);
        }

        $content = json_encode([
            'downloads' => $packages,
        ]);


        $agent = sprintf(
            'User-Agent: Composer/%s (%s; %s; %s; %s%s)',
            '1.10.' . rand(0, 19),
            function_exists('php_uname') ? php_uname('s') : 'Unknown',
            function_exists('php_uname') ? php_uname('r') : 'Unknown',
            'PHP ' . PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION . '.' . PHP_RELEASE_VERSION,
            'curl ' . curl_version()['version'],
            getenv('CI') ? '; CI' : ''
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, $agent);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10); //timeout in seconds
        curl_exec($curl);
        curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
    }
}


$updates = new Update();
$updates->check();

return 0;
