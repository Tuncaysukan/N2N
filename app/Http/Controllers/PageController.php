<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function about()
    {
        $page = Page::where('slug', 'hakkimizda')->first();
        
        if (!$page) {
            // Varsayılan içerik
            $page = (object)[
                'title_tr' => 'Hakkımızda',
                'title_en' => 'About Us',
                'content_tr' => 'N2N Tekstil olarak, Havaianas, New Era ve Nike Swim gibi dünyaca ünlü markaların Türkiye distribütörüyüz. Müşterilerimize en kaliteli ürünleri sunmayı taahhüt ediyoruz. 2010 yılında kurulan şirketimiz, moda ve perakende sektöründe edindiği tecrübe ile müşteri memnuniyetini ön planda tutmaktadır.',
                'content_en' => 'As N2N Tekstil, we are the Turkey distributor of world-famous brands like Havaianas, New Era and Nike Swim. We are committed to offering our customers the highest quality products. Founded in 2010, our company prioritizes customer satisfaction with its experience in the fashion and retail sector.',
                'meta_title_tr' => 'Hakkımızda - N2N Tekstil',
                'meta_title_en' => 'About Us - N2N Tekstil',
                'meta_description_tr' => 'N2N Tekstil hakkımızda sayfası. 2010 yılından beri Türkiye\'deki premium spor markalarının distribütörüyüz.',
                'meta_description_en' => 'N2N Tekstil about page. We have been the distributor of premium sports brands in Turkey since 2010.'
            ];
        }
        
        return view('pages.about', compact('page'));
    }
}
