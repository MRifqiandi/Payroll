<table>
    <thead>
        <tr>
            <th>kdsatker</th>
            <th>bln</th>
            <th>thn</th>
            <th>tgl</th>
            <th>nogaji</th>
            <th>nip</th>
            <th>nmpeg</th>
            <th>kdgol</th>
            <th>npwp</th>
            <th>kdbankspan</th>
            <th>nmbankspan</th>
            <th>norek</th>
            <th>nmrek</th>
            <th>nmcabbank</th>
            <th>jmlhari</th>
            <th>tarif</th>
            <th>pph</th>
            <th>kotor</th>
            <th>potongan</th>
            <th>bersih</th>
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
