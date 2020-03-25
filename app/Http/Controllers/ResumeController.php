<?php

namespace Main\Http\Controllers;

class ResumeController
{
    public function browser()
    {
        return view('resume.show', [
            'resume' => $this->getResumeFromFile(),
        ]);
    }

    private function getResumeFromFile(): array
    {
        $file_path = resource_path('content/resume.json');

        $file_contents = file_get_contents($file_path);

        return json_decode($file_contents, true);
    }
}
