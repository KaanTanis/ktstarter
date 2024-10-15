<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class CustomPages extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationLabel = 'Sayfalar';

    protected static ?string $clusterBreadcrumb = 'Sayfalar';

    protected static ?string $navigationGroup = 'CMS';
}
