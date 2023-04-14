<?php
namespace App\Middleware;

use src\Http\Response;

class AddCourse {
    public function __invoke($request, $next) {
        global $app;
        $courses = $app->getContainer()->make('App\Models\Courses');

        $path = $request->getPath();
        $method = $request->getMethod();
        $opleiding = $request->getAttribute('opleiding');
        $course = $request->getAttribute('course');
        $beschrijving = $request->getAttribute('beschrijving');

        if ($method == 'POST' && $path == '/addCourse') {
            if (empty($opleiding) || empty($course) || empty($beschrijving)) {
                return new Response(400, 'Vul alle velden in');
            }
            $courses->insertCourse($opleiding, $course, $beschrijving);
            return new Response(302, '', '/home');
        }

        return $next($request);
    }
}