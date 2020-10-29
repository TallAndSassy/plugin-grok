<?php
# Include this from /routes/web.php (because we're still learning how to auto-register our routes)

#Route::get('/admin/grok', fn () => redirect('/grok'));

Route::middleware(['auth:sanctum', 'verified'])
    ->get(
        '/admin/grok/{sublevels?}',
        [\TallAndSassy\PluginGrok\Http\Controllers\PluginGrokController::class, 'getFrontView']
    )
    ->where('sublevels', '.*');

