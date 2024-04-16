<form class="reservation_form" action="/reservation/update" method="post">
    @csrf
    <div class="reservation_form_inner">
        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

        <!-- 予約確認 -->
        <div class="reservation_confirm">
            <table class="reservation_table">
                <tr class="reservation_table_row">
                    <td>変更前のデータ</td>
                    <td></td>
                </tr>
                <tr class="reservation_table_row">
                    <td>Date</td>
                    <td>{{ $reservation->reservation_date }}</td>
                </tr>
                <tr class="reservation_table_row">
                    <td>Time</td>
                    <td>{{ date('H:i', strtotime($reservation->reservation_time)) }}</td>
                </tr>
                <tr class="reservation_table_row">
                    <td>Number</td>
                    <td>{{ $reservation->number_of_people }}人</td>
                </tr>
            </table>
        </div>

        <!-- 予約日 -->
        <div class="form_group">
            <input name="reservation_date" type="date" min="{{ now()->toDateString() }}" wire:model="date_live">
            @error('reservation_date')
            <div class="error">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- 予約時間 -->
        <div class="form_group">
            <select name="reservation_time" id="reservation_time" wire:model="time_live">
                <option value="">時刻を選択してください</option>
                @foreach ($times as $time)
                <option value="{{ $time }}">{{ $time }}</option>
                @endforeach
            </select>
            @error('reservation_time')
            <div class="error">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- 人数 -->
        <div class="form_group">
            <select name="number_of_people" id="number_of_people" wire:model="number_live">
                <option value="">人数を選択してください</option>
                @foreach ($peoples as $people)
                <option value="{{ $people }}">{{ $people }}人</option>
                @endforeach
            </select>
            @error('number_of_people')
            <div class="error">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- 予約確認 -->
        <div class="reservation_confirm">
            <table class="reservation_table">
                <tr class="reservation_table_row">
                    <td>変更後のデータ</td>
                    <td></td>
                </tr>
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

    <!-- 予約変更ボタン -->
    <div class="reservation_submit">
        <input type="hidden" name="id" value="{{ $reservation->id }}">
        <button type="submit">予約を変更する</button>
    </div>
</form>