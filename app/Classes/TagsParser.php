<?php

namespace Main\Classes;

use Symfony\Component\Yaml\Yaml;

class TagsParser
{
    public static function instance(): TagsParser
    {
        return new TagsParser();
    }

    public function getTagsForPageName(string $name): \stdClass
    {
        $all_tags = $this->getAllTags();

        $filtered_array = array_filter($all_tags, function ($tags, $pageName) use ($name) {
            return $pageName === $name;
        }, 1);

        if (isset($filtered_array[$name])) {
            return $filtered_array[$name];
        } else {
            return head($all_tags);
        }
    }

    public function getAllTags(): array
    {
        $parsed_config = $this->parseConfigFile();

        return collect($parsed_config['tags'])
            ->mapWithKeys(function ($tags, $pageName) {
                return [$pageName => $this->convertArrayToStdClass($tags)];
            })
            ->toArray();
    }

    private function convertArrayToStdClass(array $input_array): \stdClass
    {
        $output_class = new \stdClass();

        foreach (array_keys($input_array) as $key) {
            $output_class->$key = $input_array[$key];
        }

        return $output_class;
    }

    public function parseConfigFile(): array
    {
        return Yaml::parseFile(
            resource_path('content/metatags.yml')
        );
    }
}
