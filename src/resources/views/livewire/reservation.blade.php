<form class="reservation_form" action="/detail/store" method="post">
    @csrf
    <div class="reservation_form_inner">
        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
        <input name="reservation_date" type="date" min="{{ now()->toDateString() }}" wire:model="date_live">
        <select name="reservation_time" id="reservation_time" wire:model="time_live">
            <option value="">時刻を選択してください</option>
            @foreach ($times as $time)
            <option value="{{ $time }}">{{ $time }}</option>
            @endforeach
        </select>
        <select name="number_of_people" id="number_of_people" wire:model="number_live">
            <option value="">人数を選択してください</option>
            @foreach ($peoples as $people)
            <option value="{{ $people }}">{{ $people }}人</option>
            @endforeach
        </select>
        <div class="reservation_confirm">
            <table class="reservation_table">
                <tr class="reservation_table_row">
                    <td>Shop</td>
                    <td>{{ $restaurant->name }}</td>
                </tr>
                <tr class="reservation_table_row">
                    <td>Date</td>
                    <td>{{ $date_live }}</td>
                </tr>
                <tr class="reservation_table_row">
                    <td>Time</td>
                    <td>{{ $time_live }}</td>
                </tr>
                <tr class="reservation_table_row">
                    <td>Number</td>
                    <td>{{ $number_live }}人</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="reservation_submit">
        @if (Auth::check())
        <button type="submit">予約する</button>
        @else
        <a href="/login">ログインする</a>
        @endif
    </div>
</form>