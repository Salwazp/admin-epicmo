<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        .cell {
    background-color: #A20C46;
    color: #ffffff;
}
    </style>
    <table>
        <thead>
        <tr>
            <th colspan="11" style="text-align: center;"><h4>Data Contact</h4></th>
        </tr>
        <tr>
            <th class="cell">No</th>
            <th class="cell">Name</th>
            <th class="cell">Email</th>
            <th class="cell">Subject</th>
            <th class="cell">Message</th>
            <th class="cell">Create at</th>
        </tr>
        </thead>
        <tbody>
        @php $no = 1 @endphp
        @foreach($contact as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->subject }}</td>
                <td>{{ $data->message }}</td>
                <td>{{ $data->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</html>