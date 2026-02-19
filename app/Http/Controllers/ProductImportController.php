<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\Response;

class ProductImportController extends Controller
{
    public function import(Request $request)
    {
        // 🔐 1️⃣ Autorización REAL
        if (Auth::user()->role_id !== 1) {
            abort(Response::HTTP_FORBIDDEN);
        }

        // 📁 2️⃣ Validación fuerte
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv|max:5120', // máximo 5MB
        ]);

        try {

            $file = $request->file('file');

            // 🔎 Validar MIME real
            if (
                !in_array($file->getMimeType(), [
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'text/csv',
                    'application/vnd.ms-excel',
                ])
            ) {
                if ($request->wantsJson()) {
                    return response()->json([
                        'message' => 'Formato de archivo no válido',
                        'errors' => ['file' => ['Formato de archivo no válido']]
                    ], 422);
                }
                return back()->withErrors(['file' => 'Formato de archivo no válido']);
            }

            $spreadsheet = IOFactory::load($file->getPathname());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            DB::transaction(function () use ($rows) {

                $header = array_shift($rows);

                foreach ($rows as $row) {

                    if (empty($row[0])) {
                        continue;
                    }

                    $product = Product::updateOrCreate(
                        ['sku' => trim($row[0])],
                        [
                            'name' => $row[1] ?? '',
                            'description' => $row[2] ?? null,
                            'image_url' => !empty($row[3]) ? $row[3] : 'placeholder.jpg',
                            'video_url' => $row[4] ?? null,
                            'price' => (float) ($row[5] ?? 0),
                            'is_new' => (bool) ($row[6] ?? 0),
                            'is_offer' => (bool) ($row[7] ?? 0),
                            'offer_percentage' => $row[8] ?: null,
                            'offer_start_date' => $row[9] ?: null,
                            'offer_end_date' => $row[10] ?: null,
                            'release_date' => $row[11] ?: null,
                            'active' => (bool) ($row[12] ?? 1),
                        ]
                    );

                    // TAGS
                    if (!empty($row[13])) {

                        $tagIds = collect(explode(',', $row[13]))
                            ->map(fn($tag) => trim($tag))
                            ->filter()
                            ->map(function ($tagName) {
                                return Tag::firstOrCreate([
                                    'name' => $tagName,
                                ])->id;
                            });

                        $product->tags()->sync($tagIds);
                    }

                    // PLATFORMS
                    if (!empty($row[14])) {

                        $platformIds = collect(explode(',', $row[14]))
                            ->map(fn($platform) => trim($platform))
                            ->filter()
                            ->map(function ($platformName) {
                                return Platform::firstOrCreate([
                                    'name' => $platformName,
                                ])->id;
                            });

                        $product->platforms()->sync($platformIds);
                    }
                }
            });

        } catch (\Throwable $e) {

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Error al procesar el archivo.',
                    'errors' => ['file' => ['Error al procesar el archivo.']]
                ], 422);
            }

            return back()->withErrors([
                'file' => 'Error al procesar el archivo.',
            ]);
        }

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Productos importados correctamente'], 200);
        }

        return back()->with('success', 'Productos importados correctamente');
    }
}
