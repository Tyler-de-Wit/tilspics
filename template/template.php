<?php
    $filePath = $_SERVER['PHP_SELF'];


    if (strpos($filePath, "index.php")) 
    {
        $h1 = 'Tils Pics';
        $title = 'Home';
        $description = 'Home page';
        $canonical = '';
        $skipLink = '#home-page-main';
    }
    elseif (strpos($filePath, "image-gallery.php")) 
    {
        $h1 = 'Image Gallery';
        $title = 'Images';
        $description = 'Gallery of Images';
        $canonical = '';
        $skipLink = '#images-page-main';
    }  
    elseif (strpos($filePath, "contact.php")) 
    {
        $h1 = 'Contact Us';
        $title = 'Contact Us';
        $description = 'Contact Us Page';
        $canonical = '';
        $skipLink = '#contact-us-main';
    }
    elseif (strpos($filePath, "sitemap.php")) 
    {
        $h1 = 'Sitemap';
        $title = 'Sitemap';
        $description = 'Sitemap Page';
        $canonical = '';
        $skipLink = '#sitemap-page-main';
    }
    elseif (strpos($filePath, "code-of-ethics.php")) 
    {
        $h1 = 'Code Of Ethics';
        $title = 'Code Of Ethics';
        $description = 'Code Of Ethics Page';
        $canonical = '';
        $skipLink = '#code-of-ethics-page-main';
    }
    elseif (strpos($filePath, "privacy-policy.php")) 
    {
        $h1 = 'Privacy Policy';
        $title = 'Privacy Policy';
        $description = 'Privacy Policy Page';
        $canonical = '';
        $skipLink = '#privacy-policy-page-main';
    }
    elseif (strpos($filePath, "terms-and-conditions.php")) 
    {
        $h1 = 'Terms And Conditions';
        $title = 'Terms And Conditions';
        $description = 'Terms And Conditions Page';
        $canonical = '';
        $skipLink = '#terms-and-conditions-page-main';
    }
    elseif (strpos($filePath, "error404.php")) 
    {
        $h1 = 'Error404';
        $title = 'Error404';
        $description = 'Error404 Page';
        $canonical = '';
        $skipLink = '#error404-page-main';
    }