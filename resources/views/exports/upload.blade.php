<table>
    <thead>
        <tr>
            <th>NAMA</th>
            <th>EMAIL</th>
            <th>AMOUNT</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                @foreach ($data as $d)
                    <td>{{ $d }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
