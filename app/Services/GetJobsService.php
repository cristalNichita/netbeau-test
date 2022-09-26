<?php

namespace App\Services;

use App\Models\Job;
use DOMDocument;
use DOMXPath;

class GetJobsService
{
    public function allJobs() {
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('GET', 'https://www.bestjobs.eu/ro/locuri-de-munca?location=bucuresti&keyword=symfony');
        } catch (\Exception $e) {
            return response()->json($e);
        }

        return $response->getBody();
    }

    public function getLinks() {
        $html = $this->allJobs();

        $dom = new DOMDocument;
        @$dom->loadHTML($html);

        $finder = new DomXPath($dom);

        $class_name = 'js-card-link';

        $nodes = $finder->query("//*[contains(@class, '$class_name')]");

        $data = [];

        foreach($nodes as $node) {
            $name = $node->getAttribute('data-load-in-modal');
            $data[] = strtolower(str_replace(' ', '-', $name));
        }

        return $data;
    }

    public function getJobsData() {
        $client = new \GuzzleHttp\Client();
        $links = $this->getLinks();

        $data = [];
        $i = 0;
        foreach($links as $link) {
            try {
                $response = $client->request('GET', $link);
            } catch (\Exception $e) {
                return response()->json($e);
            }
            $html = $response->getBody();

            $dom = new DOMDocument();
            @$dom->loadHTML($html);

            $finder = new DomXPath($dom);

            $class_name = 'display-4 font-size-m-40 font-weight-medium text-break letter-spacing-n05 js-translate-title';
            $class_company = 'font-size-16 font-weight-bold my-0';
            $class_description = 'job-description detail-two-columns border-top border-input mt-5 pt-5 js-translate-desc';
            $class_location = 'd-flex mt-2';

            $node_name = $finder->query("//*[contains(@class, '$class_name')]");
            $node_company = $finder->query("//*[contains(@class, '$class_company')]");
            $node_description = $finder->query("//*[contains(@class, '$class_description')]");
            $node_location = $finder->query("//div[contains(@class, '$class_location')]/following-sibling::div[1]/span/a");

            $locations_arr = [];
            $num_locations = count($node_location) - 1;
            for($j = 0; $j < $num_locations; $j++){
                $locations_arr[] = str_replace([',', ' ', ';'], '', trim($node_location->item($j)->nodeValue));
            }

            $data[$i]['title'] = trim($node_name->item(0)->nodeValue);
            $data[$i]['company'] = trim($node_company->item(0)->nodeValue);
            $data[$i]['description'] = trim($node_description->item(0)->nodeValue);
            $data[$i]['location'] = implode(',', $locations_arr);

            $i++;
        }

        return $data;
    }

    public function createJobs()
    {

        $data = $this->getJobsData();

        foreach ($data as $item){
            Job::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }

        return 'ok';

    }
}
