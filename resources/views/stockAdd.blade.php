
<x-app-layout>
<form action="{{ route('stockAdd') }}" method="POST">
    @csrf
    <table>
        <tr>
            <th><label for="name">商品名：</label></th>
            <td><input type="text" id="name" name="name" required></td>
        </tr>
        <tr>
            <th><label for="explain">商品説明：</label></th>
            <td><input type="text" id="explain" name="explain" required></td>
        </tr>
        <tr>
            <th><label for="price">商品価格：</label></th>
            <td><input type="number" id="price" name="price" required></td>
        </tr>
        <tr>
            <th><label for="imagePath">商品画像：</label></th>
            <td><input type="file" name="imagePath"></td>
        </tr>
        <tr>
            <button type="submit">追加</button>
        </tr>
    </table>
</form>
</x-app-layout>
