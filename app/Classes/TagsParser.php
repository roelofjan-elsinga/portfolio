<?php

namespace Main\Classes;

use Symfony\Component\Yaml\Yaml;

class TagsParser
{
    public static function instance(): TagsParser
    {
        return new TagsParser();
    }

    /**
     * Get the meta tags for the given page name
     *
     * @param string $name
     * @return \stdClass
     */
    public function getTagsForPageName(string $name): \stdClass
    {
        $all_tags = $this->getAllTags();

        $default_tags = $this->getDefaultTags();

        $filtered_array = array_filter($all_tags, function ($tags, $pageName) use ($name) {
            return $pageName === $name;
        }, 1);

        if (isset($filtered_array[$name])) {
            return $this->fillInBlankFieldsWithDefault($filtered_array[$name], $default_tags);
        } else {
            return $this->fillInBlankFieldsWithDefault(head($all_tags), $default_tags);
        }
    }

    /**
     * Get the default tags for any missing information
     *
     * @return \stdClass
     */
    private function getDefaultTags(): \stdClass
    {
        $parsed_config = $this->parseConfigFile();

        $default_tags = collect($parsed_config['tags'])
            ->filter(function ($tags, $pageName) {
                return $pageName === 'default';
            })
            ->first();

        return $this->convertArrayToStdClass($default_tags);
    }

    /**
     * Fill in any missing fields with the default values, if they exist
     *
     * @param $tags
     * @param $default_tags
     * @return \stdClass
     */
    private function fillInBlankFieldsWithDefault($tags, $default_tags): \stdClass
    {
        foreach ($tags as $key => $value) {
            if (is_null($value) && isset($default_tags->$key)) {
                $tags->$key = $default_tags->$key;
            }
        }

        return $tags;
    }

    /**
     * Get all meta tags in the config file
     *
     * @return array
     */
    public function getAllTags(): array
    {
        $parsed_config = $this->parseConfigFile();

        return collect($parsed_config['tags'])
            ->mapWithKeys(function ($tags, $pageName) {
                return [$pageName => $this->convertArrayToStdClass($tags)];
            })
            ->toArray();
    }

    /**
     * Convert an array to a stdClass
     *
     * @param array $input_array
     * @return \stdClass
     */
    private function convertArrayToStdClass(array $input_array): \stdClass
    {
        $output_class = new \stdClass();

        foreach (array_keys($input_array) as $key) {
            $output_class->$key = $input_array[$key];
        }

        return $output_class;
    }

    /**
     * Parse the meta tags config file
     *
     * @return array
     */
    public function parseConfigFile(): array
    {
        return Yaml::parseFile(
            resource_path('content/metatags.yml')
        );
    }
}
