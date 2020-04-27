<?php


class Update
{
    /**
     * @var string[][]
     */
    public $packages = [
        [
            'name'    => 'sajya/server',
            'version' => '0.0.2.0',
        ],
        [
            'name'    => 'orchid/experiment',
            'version' => '2.2.0.0',
        ],
        //[
        //    'name'    => 'orchid/platform',
        //    'version' => '7.1.0.0',
        //],
        [
            'name'    => 'tabuna/breadcrumbs',
            'version' => '1.0.0.0',
        ]
    ];

    /**
     * @return mixed
     */
    public function check()
    {
        $this->updateInstall();
    }

    public function updateInstall()
    {
        $url = 'https://packagist.org/downloads/';

        $packages = [];

        for ($i = 0, $max = random_int(1, 7); $i < $max; $i++) {
            $packages = array_merge($packages, $this->packages);
        }

        $content = json_encode([
            'downloads' => $packages,
        ]);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
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
