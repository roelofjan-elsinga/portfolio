<?php


namespace Main\Http\Controllers;

class ResumeController
{
    public function browser()
    {
        return view('resume.show', [
            'resume' => $this->getResumeFromFile()
        ]);
    }

    private function getResumeFromFile(): array
    {
        return json_decode(
            file_get_contents(
                resource_path('content/resume.json')
            ),
            true
        );
    }
}
