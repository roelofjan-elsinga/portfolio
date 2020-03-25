<?php

namespace Main\Http\Controllers;

class ResumeController
{
    public function browser()
    {
        return view('resume.show', [
            'resume' => $this->getResumeFromFile('resume.json'),
        ]);
    }

    public function browserDutch()
    {
        app()->setLocale('nl');

        return view('resume.show', [
            'resume' => $this->getResumeFromFile('resume.nl.json'),
        ]);
    }

    private function getResumeFromFile(string $file_name): array
    {
        $file_path = resource_path("content/{$file_name}");

        $file_contents = file_get_contents($file_path);

        return json_decode($file_contents, true);
    }
}
