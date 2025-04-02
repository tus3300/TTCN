{* File: sample.tpl *}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>{$title|escape}</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>{$header_title|escape}</h1>
    </header>
    
    <nav>
        <ul>
        {foreach from=$menu item=menuItem}
            <li><a href="{$menuItem.url|escape}">{$menuItem.title|escape}</a></li>
        {/foreach}
        </ul>
    </nav>
    
    <main>
        <h2>{$content_title|escape}</h2>
        <div class="content">
            {$content}
        </div>
    </main>
    
    <footer>
        <p>&copy; {$current_year} - Your Website Name</p>
    </footer>
</body>
</html>
