<?php

namespace Main\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class ResumeController
{
    public function browser()
    {
        return view('resume.show', [
            'resume' => $this->getResumeFromFile('resume.json'),
            'lang' => 'en'
        ]);
    }

    public function browserDutch()
    {
        return view('resume.show', [
            'resume' => $this->getResumeFromFile('resume.nl.json'),
            'lang' => 'nl'
        ]);
    }

    private function getResumeFromFile(string $file_name): array
    {
        $file_path = resource_path("content/{$file_name}");

        $file_contents = file_get_contents($file_path);

        return json_decode($file_contents, true);
    }
}
