<?php

namespace App\Http\Controllers;

use RalphJSmit\Laravel\SEO\Support\SEOData;


abstract class Controller
{

    public function show()
        {
            seo()->for(
                new SEOData(
                    title: 'Home Page',
                    description: 'Welcome to our website.',
                    image: asset('images/logo.png'),
                    author: 'Aruqat',
                )
            );

            return view('home');
        }



}



