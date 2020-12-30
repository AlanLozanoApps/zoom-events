@php $editing = isset($chat) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-md-12 col-lg-12">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $chat->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-md-12 col-lg-12">
        <x-inputs.textarea
            name="message"
            label="Message"
            maxlength="255"
            required
            >{{ old('message', ($editing ? $chat->message : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
