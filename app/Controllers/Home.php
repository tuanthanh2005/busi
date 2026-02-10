<?php
class Home extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Poseify - Modeling Agency',
            'active' => 'home'
        ];
        $this->view('home/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Us - Poseify',
            'active' => 'about'
        ];
        $this->view('home/about', $data);
    }

    public function service()
    {
        $data = [
            'title' => 'Services - Poseify',
            'active' => 'service'
        ];
        $this->view('home/service', $data);
    }

    public function team()
    {
        $data = [
            'title' => 'Our Models - Poseify',
            'active' => 'pages',
            'sub_active' => 'team'
        ];
        $this->view('home/team', $data);
    }

    public function testimonial()
    {
        $data = [
            'title' => 'Testimonials - Poseify',
            'active' => 'pages',
            'sub_active' => 'testimonial'
        ];
        $this->view('home/testimonial', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact Us - Poseify',
            'active' => 'contact'
        ];
        $this->view('home/contact', $data);
    }

    public function error()
    {
        $data = [
            'title' => '404 Not Found - Poseify',
            'active' => 'pages',
            'sub_active' => 'error'
        ];
        $this->view('home/error', $data);
    }
}

