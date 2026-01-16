@props([
    'name',
    'price',
    'description',
    'comments' => collect()
])

<div class="max-w-4xl mx-auto bg-gray-800 rounded-2xl shadow-2xl overflow-hidden border border-gray-700">
    <div class="md:flex">
        <div class="md:w-1/3 bg-gray-700 aspect-[3/4] flex items-center justify-center">
             <span class="text-gray-500">Portada</span>
        </div>
        <div class="p-8 md:w-2/3">
            <h1 class="text-4xl font-black text-orange-500 mb-2">{{ $name }}</h1>
            <p class="text-2xl font-bold mb-6 text-white">{{ $price }}€</p>
            
            <h3 class="text-gray-400 uppercase tracking-widest text-sm font-bold mb-2">Descripción</h3>
            <p class="text-gray-300 leading-relaxed mb-8">
                {{ $description }}
            </p>

            <div class="border-t border-gray-700 pt-6">
                <h3 class="font-bold text-white mb-4">Comentarios de los usuarios ({{ $comments->count() }})</h3>
                
                @forelse($comments as $comment)
                    <div class="bg-gray-900 p-3 rounded mb-2 border-l-2 border-orange-500">
                        <div class="flex justify-between">
                            <p class="text-sm text-gray-400 font-bold">{{ $comment->user->name ?? 'Usuario Anónimo' }}</p>
                            <p class="text-orange-500 text-sm">Puntuación: {{ $comment->rating }}/5</p>
                        </div>
                        <p class="text-gray-200 mt-1">{{ $comment->message }}</p>
                    </div>
                @empty
                    <p class="text-gray-500 italic">Aún no hay comentarios para este producto.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>