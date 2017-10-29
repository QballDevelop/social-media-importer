<?php

namespace Codenetix\SocialMediaImporter\Importers;

use Codenetix\SocialMediaImporter\Adapters\DraugiemMediaAdapter;
use Codenetix\SocialMediaImporter\FactoryMethods\MediaFactoryMethod;

/**
 * @author Andrey Vorobiov<andrew.sprw@gmail.com>
 */
class DraugiemBulkMediaImporter extends ADraugiemMediaImporter
{

    public function importByKeyword($keyword)
    {
        $page = 1;
        $items = [];
        do {
            $result = $this->draugiemClient->apiCall('rasens/search', ['keyword' => $keyword, 'pg' => $page, 'count' => 10]);
            foreach ($result['items'] as $item) {
                array_push($items, (new DraugiemMediaAdapter($item))->transform(new MediaFactoryMethod()));
            }
            $page++;
        } while (!empty($result['items']));

        return $items;
    }
}