<?php

if (!defined('e107_INIT'))
{
    exit;
}

// v2.x Standard  - Simple mod-rewrite module. 

class eauthors_url // plugin-folder + '_url'
{
   

    function config()
    {
        $alias = 'authors';

        $config['authors'] = array(
            'alias'         => $alias,
            'regex'            => '^{alias}\/?([\?].*)?\/?$',
            'sef'            => '{alias}',
            'redirect'        => '{e_PLUGIN}eauthors/authors.php$1',
        );


        $config['admin'] = array(
            'alias'         => $alias,
            'regex'            => '^{alias}\/admin/$',
            'sef'            => '{alias}/admin',
            'redirect'        => '{e_PLUGIN}eauthors/admin_config.ph$1',

        );

        $config['dashboard'] = array(
            'alias'         => $alias,
            'regex'            => '^{alias}\/dashboard\/?([\?].*)?\/?$',
            'sef'            => '{alias}/dashboard/',
            'redirect'        => '{e_PLUGIN}eauthors/author_dashboard.php$1',

        );

        return $config;
    }
}
