<style>
    /* border table */
    .table-bordered td,
    .table-bordered th {
        border: 1px solid black;
    }

</style>
<table class="table-bordered">
    <thead>
        <tr>
            <th rowspan="2">Nomor</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Email</th>
            <th rowspan="2">Kelas</th>
            <th rowspan="2">Nomor Soal</th>
            <th colspan="4">jawaban</th>
            <th rowspan="2">Kategori</th>
            <th rowspan="2">Hasil</th>
        </tr>
        <tr>
            <th>Tier 1</th>
            <th>Tier 2</th>
            <th>Tier 3</th>
            <th>Tier 4</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            @foreach ($user->participant->participantTest->participantTestQuestionAnswers as $question)
                <tr>
                    <td>{{ $loop->first ? $loop->parent->iteration : '' }}</td>
                    <td>{{ $loop->first ? $user->participant->name : '' }}</td>
                    <td>{{ $loop->first ? $user->participant->school_origin : '' }}</td>
                    <td>{{ $loop->first ? $user->participant->class : '' }}</td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $question->answer }}</td>
                    <td>{{ $question->confidence_answer ? 'yakin' : 'tidak yakin' }}</td>
                    <td>{{ $question->answer_reason }}</td>
                    <td>{{ $question->confidence_answer_reason ? 'yakin' : 'tidak yakin' }}</td>
                    <td>{{ $question->testResultCategory->name ?? '' }}</td>
                    @if ($loop->first)
                        <td
                            rowspan="{{ $user->participant->participantTest->participantTestQuestionAnswers()->count() }}">
                            PK =
                            {{ round($user->participant->participantTest->participantTestResult->participantTestResultDetails->where('test_result_category_id', 3)->first()->percent) }}
                            %
                            <br>
                            TPK =
                            {{ round($user->participant->participantTest->participantTestResult->participantTestResultDetails->where('test_result_category_id', 2)->first()->percent) }}
                            %
                            <br>
                            MSC =
                            {{ round($user->participant->participantTest->participantTestResult->participantTestResultDetails->where('test_result_category_id', 1)->first()->percent) }}

                            %
                        </td>
                    @endif
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
