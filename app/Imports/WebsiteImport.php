<?php

namespace App\Imports;

use App\Models\ShortLink;
use AshAllenDesign\ShortURL\Facades\ShortURL;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class WebsiteImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        $user = Auth::user();
        foreach ($rows as $row) {
            $shortURL = ShortURL::destinationUrl($row['url'])->make();
            ShortLink::create([
                'website_url' => $shortURL['destination_url'],
                'short_url' => $shortURL['url_key'],
                'user_id' => $user->id,
            ]);
        }
    }

}
