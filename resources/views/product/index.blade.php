<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Products
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 px-4 py-3 rounded relative" role="alert"
                    style="background-color: #d4edda; color: #155724; border-color: #c3e6cb;">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="overflow-x-auto">
                    <div class="min-w-full align-middle">
                        @if (auth()->user()->is_admin)
                            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                                <a href="{{ route('products.create') }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white font-medium text-sm rounded-lg shadow-sm transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add New Product
                                </a>
                            </div>
                        @endif
                    </div>
                    <table class="w-full table-fixed border border-gray-300">
                        <thead>
                            <tr class="border-b-2 border-gray-300">
                                <th
                                    class="w-2/5 px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider border border-gray-300">
                                    Product
                                </th>
                                <th
                                    class="w-2/5 px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider border border-gray-300">
                                    Price
                                </th>
                                @if (auth()->user()->is_admin)
                                    <th
                                        class="w-1/5 px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider border border-gray-300">
                                        Actions
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                            @forelse ($products as $product)
                                <tr class="hover:bg-gray-50 transition-colors border-b border-gray-300">
                                    <td
                                        class="w-2/5 px-6 py-4 text-sm font-medium text-gray-900 border border-gray-300">
                                        {{ $product->name }}
                                    </td>
                                    <td class="w-2/5 px-6 py-4 text-sm text-gray-600 border border-gray-300">
                                        ${{ number_format($product->price, 2) }}
                                    </td>
                                    @if (auth()->user()->is_admin)
                                        <td class="w-1/5 px-6 py-4 text-sm text-gray-600 border border-gray-300">
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ auth()->user()->is_admin ? 3 : 2 }}"
                                        class="px-6 py-4 text-sm text-gray-600 text-center">
                                        No products found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
