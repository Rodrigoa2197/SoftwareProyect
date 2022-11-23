@extends('layouts.admin')

@section('title')
    {{ __('Site Settings') }}
@endsection 

@php
//  dd($settings);
if ($settings['color']) {
    $color = $settings['color'];
}

@endphp

@push('css')
    <style>
        .doc-img>a,
        .theme-color>a {
            position: relative;
            width: 35px;
            height: 25px;
            border-radius: 3px;
            display: inline-block;
            background: #f8f9fd;
            overflow: hidden;
            box-shadow: 0 1px 2px rgb(0 0 0 / 28%);
        }
    </style>
@endpush


@php
$logo=\App\Models\Utility::get_file('logo/');
$file_type = config('files_types');
$settings = App\Models\Utility::settingsById();
$local_storage_validation    = $settings['local_storage_validation'];
$local_storage_validations   = explode(',', $local_storage_validation);

$s3_storage_validation    = $settings['s3_storage_validation'];
$s3_storage_validations   = explode(',', $s3_storage_validation);

$wasabi_storage_validation    = $settings['wasabi_storage_validation'];
$wasabi_storage_validations   = explode(',', $wasabi_storage_validation);
@endphp


@section('content')
    <div class="row">
        <div class="col-lg-4 order-lg-2">
            <div class="card">
                <div class="list-group list-group-flush" id="tabs">
                    <div data-href="#tabs-1" class="list-group-item text-primary">
                        <div class="media">
                            <i class="fas fa-cog pt-1"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1">{{ __('Site Setting') }}</a>
                                <p class="mb-0 text-sm">{{ __('Details about your personal information') }}</p>
                            </div>
                        </div>
                    </div>
                    <div data-href="#tabs-2" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-envelope pt-1"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1">{{ __('Mailer Settings') }}</a>
                                <p class="mb-0 text-sm">{{ __('Details about your mail setting information') }}</p>
                            </div>
                        </div>
                    </div>
                    <div data-href="#tabs-3" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-comments pt-1"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1">{{ __('Pusher Settings') }}</a>
                                <p class="mb-0 text-sm">{{ __('Details about your pusher setting information for chat') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div data-href="#tabs-4" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-money-check-alt pt-1"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1">{{ __('ReCaptcha Settings') }}</a>
                                <p class="mb-0 text-sm">
                                    {{ __('Test to tell human and bots apart by adding Recaptcha setting') }}</p>
                            </div>
                        </div>
                    </div>
                    <div data-href="#storage_setting" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-store pt-1"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1">{{ __('Storage Setting') }}</a>
                                 <p class="mb-0 text-sm">
                                    {{ __('Details about your storage settings information.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 order-lg-1">
            <div id="tabs-1" class="tabs-card">
                <div class="card">
                    <div class="card-header">
                        <h5 class="h6 mb-0">{{ __('Basic Setting') }}</h5>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['route' => ['settings.store'], 'id' => 'update_setting', 'enctype' => 'multipart/form-data']) }}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('full_logo', __('Logo'), ['class' => 'form-control-label']) }}
                                    <input type="file" name="full_logo" id="full_logo" class="custom-input-file"
                                        onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" />
                                    <label for="full_logo">
                                        <i class="fa fa-upload"></i>
                                        <span>{{ __('Choose a file…') }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pt-5">
                                <a href="{{$logo.'logo.png'}}" target="_blank">
                                    <img src="{{$logo.'logo.png'}}" id="blah"
                                        class="img_setting" />
                                </a>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('favicon', __('Favicon'), ['class' => 'form-control-label']) }}
                                    <input type="file" name="favicon" id="favicon" class="custom-input-file"
                                        onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])" />
                                    <label for="favicon">
                                        <i class="fa fa-upload"></i>
                                        <span>{{ __('Choose a file…') }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pt-5">
                                <a href="{{$logo.'favicon.png'}}" target="_blank">
                                    <img src="{{ $logo.'favicon.png' }}" id="blah1"
                                        class="img_setting" />
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('header_text', __('Title Text'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('header_text', $settings['header_text'], ['class' => 'form-control', 'placeholder' => __('Enter Header Title Text')]) }}
                                    {{-- {{ dd($settings['header_text']) }} --}}
                                </div>

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('footer_text', __('Footer Text'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('footer_text', $settings['footer_text'], ['class' => 'form-control', 'placeholder' => __('Enter Footer Text')]) }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">

                                    {{ Form::label('default_language', __('Default Language'), ['class' => 'form-control-label text-dark']) }}
                                    <select name="default_language" id="default_language" class="form-control select2">
                                        @foreach (Utility::languages() as $language)
                                            <option @if (Utility::getValByName('default_language') == $language) selected @endif
                                                value="{{ $language }}">{{ Str::upper($language) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('timezone', __('Timezone'), ['class' => 'form-control-label text-dark']) }}
                                    <select name="timezone" id="timezone" class="form-control select2">
                                        @foreach ($timezones as $k => $timezone)
                                            <option value="{{ $k }}"
                                                {{ env('TIMEZONE') == $k ? 'selected' : '' }}>{{ $timezone }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mt-lg-5">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="enable_landing"
                                        id="enable_landing"
                                        {{ \App\Models\Utility::getValByName('enable_landing') == 'on' ? 'checked' : '' }}>
                                    <label class="custom-control-label form-control-label"
                                        for="enable_landing">{{ __('Enable Landing Page') }}</label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mt-lg-5">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="enable_rtl"
                                        id="enable_rtl"
                                        {{ \App\Models\Utility::getValByName('enable_rtl') == 'on' ? 'checked' : '' }}>
                                    <label class="custom-control-label form-control-label"
                                        for="enable_rtl">{{ __('Enable RTL') }}</label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mt-lg-5">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input gdpr_fulltime gdpr_type"
                                        name="gdpr_cookie" id="gdpr_cookie"
                                        {{ isset($settings['gdpr_cookie']) && $settings['gdpr_cookie'] == 'on' ? 'checked="checked"' : '' }}>
                                    <label class="custom-control-label form-control-label"
                                        for="gdpr_cookie">{{ __('GDPR Cookie') }}</label>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mt-lg-5">
                                <div class="custom-control custom-switch">
                                    {{-- {{ dd(\App\Models\Utility::getValByName('SIGNUP')) }} --}}
                                    <input type="checkbox" class="custom-control-input" name="SIGNUP" id="SIGNUP"
                                        {{ isset($settings['SIGNUP']) && $settings['SIGNUP'] == 'on' ? 'checked="checked"' : '' }}>
                                    <label class="custom-control-label form-control-label"
                                        for="SIGNUP">{{ __('SIGNUP') }}</label>
                                </div>
                            </div>

                            <div class="col-4">
                                <h6 class="">
                                    <i data-feather="credit-card" class="me-2"></i>{{ __('Primary color settings') }}
                                </h6>
                                <hr class="my-2" />
                                <div class="theme-color themes-color">

                                 
                                        <a href="#!" class="theme-2 {{($color =='#6fd943') ? 'active_color' : ''}}" data-value="#6fd943" onclick="check_theme('#6fd943')"></a>
                                        <input type="radio" class="theme_color " name="color" value="#6fd943" style="display: none;">
                                        
                                        <a href="#!" class="theme-1 {{($color =='#a83f85') ? 'active_color' : ''}}" data-value="#a83f85" onclick="check_theme('#a83f85')"></a>
                                        <input type="radio" class="theme_color " name="color" value="#a83f85" style="display: none;">
                                        
                                        <a href="#!" class="theme-3 {{($color =='theme-3') ? 'active_color' : ''}}" data-value="theme-3" onclick="check_theme('#449fc6')"></a>
                                        <input type="radio" class="theme_color " name="color" value="#449fc6" style="display: none;">

                                        <a href="#!" class="theme-4 {{($color =='#51459d') ? 'active_color' : ''}}" data-value="theme-4" onclick="check_theme('#51459d')"></a>
                                        <input type="radio" class="theme_color " name="color" value="#51459d" style="display: none;">

                                </div>
                            </div>

                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('footer_link_1', __('Footer Link Title 1'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('footer_link_1', \App\Models\Utility::getValByName('footer_link_1'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Footer Link Title 1')]) }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('footer_value_1', __('Footer Link href 1'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('footer_value_1', \App\Models\Utility::getValByName('footer_value_1'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Footer Link 1')]) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('footer_link_2', __('Footer Link Title 2'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('footer_link_2', \App\Models\Utility::getValByName('footer_link_2'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Footer Link Title 2')]) }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('footer_value_2', __('Footer Link href 2'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('footer_value_2', \App\Models\Utility::getValByName('footer_value_2'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Footer Link 2')]) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('footer_link_3', __('Footer Link Title 3'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('footer_link_3', \App\Models\Utility::getValByName('footer_link_3'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Footer Link Title 3')]) }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('footer_value_3', __('Footer Link href 3'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('footer_value_3', \App\Models\Utility::getValByName('footer_value_3'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Footer Link 3')]) }}
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            {{ Form::hidden('from', 'site_setting') }}
                            <button type="submit"
                                class="btn btn-sm btn-primary rounded-pill">{{ __('Save changes') }}</button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div id="tabs-2" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <h5 class="h6 mb-0">{{ __('Mailer Settings') }}</h5>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['route' => ['settings.store'], 'id' => 'update_setting']) }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('mail_driver', __('Mail Driver'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('mail_driver', env('MAIL_DRIVER'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Mail Driver')]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('mail_host', __('Mail Host'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('mail_host', env('MAIL_HOST'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Mail Host')]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('mail_port', __('Mail Port'), ['class' => 'form-control-label']) }}
                                    {{ Form::number('mail_port', env('MAIL_PORT'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Mail Port'), 'min' => '0']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('mail_username', __('Mail Username'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('mail_username', env('MAIL_USERNAME'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Mail Username')]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('mail_password', __('Mail Password'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('mail_password', env('MAIL_PASSWORD'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Mail Password')]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('mail_encryption', __('Mail Encryption'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('mail_encryption', env('MAIL_ENCRYPTION'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Mail Encryption')]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('mail_from_address', __('Mail From Address'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('mail_from_address', env('MAIL_FROM_ADDRESS'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Mail From Address')]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('mail_from_name', __('Mail From Name'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('mail_from_name', env('MAIL_FROM_NAME'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Mail From Name')]) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="text-left">
                                    <button type="button" class="btn btn-sm btn-warning rounded-pill send_email"
                                        data-title="{{ __('Send Test Mail') }}"
                                        data-url="{{ route('test.email') }}">{{ __('Send Test Mail') }}</button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    {{ Form::hidden('from', 'mail') }}
                                    <button type="submit"
                                        class="btn btn-sm btn-primary rounded-pill">{{ __('Save changes') }}</button>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div id="tabs-3" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <h5 class="h6 mb-0">{{ __('Pusher Settings') }}</h5>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['route' => ['settings.store'], 'id' => 'update_setting']) }}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('pusher_app_id', __('Pusher App Id'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('pusher_app_id', env('PUSHER_APP_ID'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Pusher App Id')]) }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('pusher_app_key', __('Pusher App Key'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('pusher_app_key', env('PUSHER_APP_KEY'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Pusher App Key')]) }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('pusher_app_secret', __('Pusher App Secret'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('pusher_app_secret', env('PUSHER_APP_SECRET'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Pusher App Secret')]) }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('pusher_app_cluster', __('Pusher App Cluster'), ['class' => 'form-control-label']) }}
                                    {{ Form::text('pusher_app_cluster', env('PUSHER_APP_CLUSTER'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Pusher App Cluster')]) }}
                                </div>
                            </div>
                            <div class="col-12">
                                <small><a href="https://pusher.com/channels"
                                        target="_blank">{{ __('You can Make Pusher channel Account from here and Get your App Id and Secret key') }}</a></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="text-right">
                                    {{ Form::hidden('from', 'pusher') }}
                                    <button type="submit"
                                        class="btn btn-sm btn-primary rounded-pill">{{ __('Save changes') }}</button>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div id="tabs-4" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <h5 class="h6 mb-0">{{ __('ReCaptcha Settings') }}</h5>
                        <small>{{ __('Test to tell human and bots apart by adding Recaptcha setting.') }}</small>
                    </div>
                    <div id="recaptcha-settings" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    {{-- <h4 class="h4 font-weight-400 float-left pb-2">{{ __('ReCaptcha settings') }}</h4> --}}
                                </div>
                            </div>
                            <div class="p-3">
                                <form method="POST" action="{{ route('recaptcha.settings.store') }}"
                                    accept-charset="UTF-8">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input"
                                                    name="recaptcha_module" id="recaptcha_module" value="yes"
                                                    {{ env('RECAPTCHA_MODULE') == 'yes' ? 'checked="checked"' : '' }}>
                                                <label class="custom-control-label form-control-label"
                                                    for="recaptcha_module">
                                                    {{ __('Google Recaptcha') }}
                                                    <a href="https://phppot.com/php/how-to-get-google-recaptcha-site-and-secret-key/"
                                                        target="_blank" class="text-blue">
                                                        <small>({{ __('How to Get Google reCaptcha Site and Secret key') }})</small>
                                                    </a>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="google_recaptcha_key"
                                                class="form-control-label">{{ __('Google Recaptcha Key') }}</label>
                                            <input class="form-control"
                                                placeholder="{{ __('Enter Google Recaptcha Key') }}"
                                                name="google_recaptcha_key" type="text"
                                                value="{{ env('NOCAPTCHA_SITEKEY') }}" id="google_recaptcha_key">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="google_recaptcha_secret"
                                                class="form-control-label">{{ __('Google Recaptcha Secret') }}</label>
                                            <input class="form-control "
                                                placeholder="{{ __('Enter Google Recaptcha Secret') }}"
                                                name="google_recaptcha_secret" type="text"
                                                value="{{ env('NOCAPTCHA_SECRET') }}" id="google_recaptcha_secret">
                                        </div>
                                    </div>
                                    <div class="col-lg-12  text-right">
                                        <input type="submit" value="{{ __('Save Changes') }}"
                                            class="btn btn-sm btn-primary rounded-pill">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div id="storage_setting" class="tabs-card d-none">
                <div class="card">
           {{ Form::open(array('route' => 'storage.setting.store', 'enctype' => "multipart/form-data")) }}
               <div class="card-header">
                   <div class="row">
                       <div class="col-lg-10 col-md-10 col-sm-10">
                           <h5 class="">{{ __('Storage Settings') }}</h5>
                       </div>
                   </div>
               </div>
               <div class="card-body">
                   <div class="d-flex">
                       <div class="pe-2">
                           <input type="radio" class="btn-check" name="storage_setting" id="local-outlined" autocomplete="off" {{  $settings['storage_setting'] == 'local'?'checked':'' }} value="local" checked>
                           <label class="btn btn-outline-primary" for="local-outlined">{{ __('Local') }}</label>
                       </div>
                       <div  class="pe-2">
                           <input type="radio" class="btn-check" name="storage_setting" id="s3-outlined" autocomplete="off" {{  $settings['storage_setting']=='s3'?'checked':'' }}  value="s3">
                           <label class="btn btn-outline-primary" for="s3-outlined"> {{ __('AWS S3') }}</label>
                       </div>

                       <div  class="pe-2">
                           <input type="radio" class="btn-check" name="storage_setting" id="wasabi-outlined" autocomplete="off" {{  $settings['storage_setting']=='wasabi'?'checked':'' }} value="wasabi">
                           <label class="btn btn-outline-primary" for="wasabi-outlined">{{ __('Wasabi') }}</label>
                       </div>
                   </div>
                   <div  class="mt-4">
                   <div class="local-setting row {{  $settings['storage_setting']=='local'?' ':'d-none' }}">
                    
                       <div class="form-group col-8 switch-width">
                           {{Form::label('local_storage_validation',__('Only Upload Files'),array('class'=>' form-control-label')) }}
                               <select name="local_storage_validation[]" class="multi-select" data-toggle="select2"  id="local_storage_validation" multiple="multiple">
                                   @foreach($file_type as $f)
                                       <option @if (in_array($f, $local_storage_validations)) selected @endif>{{$f}}</option>
                                   @endforeach
                               </select>
                       </div>
                       <div class="col-lg-4">
                           <div class="form-group">
                               <label class="form-control-label" for="local_storage_max_upload_size">{{ __('Max upload size ( In KB)')}}</label>
                               <input type="number" name="local_storage_max_upload_size" class="form-control" value="{{(!isset($settings['local_storage_max_upload_size']) || is_null($settings['local_storage_max_upload_size'])) ? '' : $settings['local_storage_max_upload_size']}}" placeholder="{{ __('Max upload size') }}">
                           </div>
                       </div>
                   </div>
                   
                   <div class="s3-setting row {{  $settings['storage_setting']=='s3'?' ':'d-none' }}">
                       
                       <div class=" row ">
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label class="form-control-label" for="s3_key">{{ __('S3 Key') }}</label>
                                   <input type="text" name="s3_key" class="form-control" value="{{(!isset($settings['s3_key']) || is_null($settings['s3_key'])) ? '' : $settings['s3_key']}}" placeholder="{{ __('S3 Key') }}">
                               </div>
                           </div>
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label class="form-control-label" for="s3_secret">{{ __('S3 Secret') }}</label>
                                   <input type="text" name="s3_secret" class="form-control" value="{{(!isset($settings['s3_secret']) || is_null($settings['s3_secret'])) ? '' : $settings['s3_secret']}}" placeholder="{{ __('S3 Secret') }}">
                               </div>
                           </div>
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label class="form-control-label" for="s3_region">{{ __('S3 Region') }}</label>
                                   <input type="text" name="s3_region" class="form-control" value="{{(!isset($settings['s3_region']) || is_null($settings['s3_region'])) ? '' : $settings['s3_region']}}" placeholder="{{ __('S3 Region') }}">
                               </div>
                           </div>
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label class="form-control-label" for="s3_bucket">{{ __('S3 Bucket') }}</label>
                                   <input type="text" name="s3_bucket" class="form-control" value="{{(!isset($settings['s3_bucket']) || is_null($settings['s3_bucket'])) ? '' : $settings['s3_bucket']}}" placeholder="{{ __('S3 Bucket') }}">
                               </div>
                           </div>
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label class="form-control-label" for="s3_url">{{ __('S3 URL')}}</label>
                                   <input type="text" name="s3_url" class="form-control" value="{{(!isset($settings['s3_url']) || is_null($settings['s3_url'])) ? '' : $settings['s3_url']}}" placeholder="{{ __('S3 URL')}}">
                               </div>
                           </div>
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label class="form-control-label" for="s3_endpoint">{{ __('S3 Endpoint')}}</label>
                                   <input type="text" name="s3_endpoint" class="form-control" value="{{(!isset($settings['s3_endpoint']) || is_null($settings['s3_endpoint'])) ? '' : $settings['s3_endpoint']}}" placeholder="{{ __('S3 Bucket') }}">
                               </div>
                           </div>
                           <div class="form-group col-8 switch-width">
                               {{Form::label('s3_storage_validation',__('Only Upload Files'),array('class'=>' form-control-label')) }}
                                   <select name="s3_storage_validation[]" class="multi-select" data-toggle="select2" id="s3_storage_validation" multiple = "multiple">
                                       @foreach($file_type as $f)
                                           <option @if (in_array($f, $s3_storage_validations)) selected @endif>{{$f}}</option>
                                       @endforeach
                                   </select>
                           </div>
                           <div class="col-lg-4">
                               <div class="form-group">
                                   <label class="form-control-label" for="s3_max_upload_size">{{ __('Max upload size ( In KB)')}}</label>
                                   <input type="number" name="s3_max_upload_size" class="form-control" value="{{(!isset($settings['s3_max_upload_size']) || is_null($settings['s3_max_upload_size'])) ? '' : $settings['s3_max_upload_size']}}" placeholder="{{ __('Max upload size') }}">
                               </div>
                           </div>
                       </div>
                   </div>

                   <div class="wasabi-setting row {{  $settings['storage_setting']=='wasabi'?' ':'d-none' }}">
                       <div class=" row ">
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label class="form-control-label" for="s3_key">{{ __('Wasabi Key') }}</label>
                                   <input type="text" name="wasabi_key" class="form-control" value="{{(!isset($settings['wasabi_key']) || is_null($settings['wasabi_key'])) ? '' : $settings['wasabi_key']}}" placeholder="{{ __('Wasabi Key') }}">
                               </div>
                           </div>
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label class="form-control-label" for="s3_secret">{{ __('Wasabi Secret') }}</label>
                                   <input type="text" name="wasabi_secret" class="form-control" value="{{(!isset($settings['wasabi_secret']) || is_null($settings['wasabi_secret'])) ? '' : $settings['wasabi_secret']}}" placeholder="{{ __('Wasabi Secret') }}">
                               </div>
                           </div>
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label class="form-control-label" for="s3_region">{{ __('Wasabi Region') }}</label>
                                   <input type="text" name="wasabi_region" class="form-control" value="{{(!isset($settings['wasabi_region']) || is_null($settings['wasabi_region'])) ? '' : $settings['wasabi_region']}}" placeholder="{{ __('Wasabi Region') }}">
                               </div>
                           </div>
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label class="form-control-label" for="wasabi_bucket">{{ __('Wasabi Bucket') }}</label>
                                   <input type="text" name="wasabi_bucket" class="form-control" value="{{(!isset($settings['wasabi_bucket']) || is_null($settings['wasabi_bucket'])) ? '' : $settings['wasabi_bucket']}}" placeholder="{{ __('Wasabi Bucket') }}">
                               </div>
                           </div>
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label class="form-control-label" for="wasabi_url">{{ __('Wasabi URL')}}</label>
                                   <input type="text" name="wasabi_url" class="form-control" value="{{(!isset($settings['wasabi_url']) || is_null($settings['wasabi_url'])) ? '' : $settings['wasabi_url']}}" placeholder="{{ __('Wasabi URL')}}">
                               </div>
                           </div>
                           <div class="col-lg-6">
                               <div class="form-group">
                                   <label class="form-control-label" for="wasabi_root">{{ __('Wasabi Root')}}</label>
                                   <input type="text" name="wasabi_root" class="form-control" value="{{(!isset($settings['wasabi_root']) || is_null($settings['wasabi_root'])) ? '' : $settings['wasabi_root']}}" placeholder="{{ __('Wasabi Bucket') }}">
                               </div>
                           </div>
                           <div class="form-group col-8 switch-width">
                               {{Form::label('wasabi_storage_validation',__('Only Upload Files'),array('class'=>'form-control-label')) }}

                               <select name="wasabi_storage_validation[]" class="multi-select" data-toggle="select2" id="wasabi_storage_validation" multiple = 'multiple'>
                                   @foreach($file_type as $f)
                                       <option @if (in_array($f, $wasabi_storage_validations)) selected @endif>{{$f}}</option>
                                   @endforeach
                               </select>
                           </div>
                           <div class="col-lg-4">
                               <div class="form-group">
                                   <label class="form-control-label" for="wasabi_root">{{ __('Max upload size ( In KB)')}}</label>
                                   <input type="number" name="wasabi_max_upload_size" class="form-control" value="{{(!isset($settings['wasabi_max_upload_size']) || is_null($settings['wasabi_max_upload_size'])) ? '' : $settings['wasabi_max_upload_size']}}" placeholder="{{ __('Max upload size') }}">
                               </div>
                           </div>
                           
                       </div>
                   </div>
               </div>

                <div class="card-footer  text-right">
                    <input type="submit" value="{{ __('Save Changes') }}"class="btn btn-sm btn-primary rounded-pill">
               </div>
           
           {{Form::close()}}
       </div>
  </div>
</div>



        </div>
    </div>
@endsection

@push('script')
    <script>
        // For Sidebar Tabs
        $(document).ready(function() {
            $('.list-group-item').on('click', function() {
                var href = $(this).attr('data-href');
                $('.tabs-card').addClass('d-none');
                $(href).removeClass('d-none');
                $('#tabs .list-group-item').removeClass('text-primary');
                $(this).addClass('text-primary');
            });
        });

        // For Test Email Send
        $(document).on("click", '.send_email', function(e) {
            e.preventDefault();
            var title = $(this).attr('data-title');
            var size = 'md';
            var url = $(this).attr('data-url');
            if (typeof url != 'undefined') {
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-' + size);
                $("#commonModal").modal('show');

                $.post(url, {
                    mail_driver: $("#mail_driver").val(),
                    mail_host: $("#mail_host").val(),
                    mail_port: $("#mail_port").val(),
                    mail_username: $("#mail_username").val(),
                    mail_password: $("#mail_password").val(),
                    mail_encryption: $("#mail_encryption").val(),
                    mail_from_address: $("#mail_from_address").val(),
                    mail_from_name: $("#mail_from_name").val(),
                }, function(data) {
                    $('#commonModal .modal-body').html(data);
                });
            }
        });
        $(document).on('submit', '#test_email', function(e) {
            e.preventDefault();
            $("#email_sanding").show();
            var post = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                type: "post",
                url: url,
                data: post,
                cache: false,
                success: function(data) {
                    if (data.is_success) {
                        show_toastr('Success', data.message, 'success');
                    } else {
                        show_toastr('Error', data.message, 'error');
                    }
                    $("#email_sanding").hide();
                }
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            if ($('.gdpr_fulltime').is(':checked')) {

                $('.fulltime').show();
            } else {

                $('.fulltime').hide();
            }

            $('#gdpr_cookie').on('change', function() {
                if ($('.gdpr_fulltime').is(':checked')) {

                    $('.fulltime').show();
                } else {

                    $('.fulltime').hide();
                }
            });
        });
    </script>  

<script>
    // function check_theme(color_val) {
    //     // alert(color_val);
    //     $('.theme-color').prop('checked', false);
    //     $('input[value="'+color_val+'"]').prop('checked', true);
    // }


    function check_theme(color_val) {                                
        $('input[value="' + color_val + '"]').prop('checked', true);
        $('input[value="' + color_val + '"]').attr('checked', true);
        $('a[data-value]').removeClass('active_color');
        $('a[data-value="' + color_val + '"]').addClass('active_color');
    }


                if ($(".multi-select").length > 0) {
            $( $(".multi-select") ).each(function( index,element ) {
                var id = $(element).attr('id');
                   var multipleCancelButton = new Choices(
                        '#'+id, {
                            removeItemButton: true,
                           
                        }
                    );
            });
       }
       
         $(document).on('change','[name=storage_setting]',function(){
            if($(this).val() == 's3'){
                $('.s3-setting').removeClass('d-none');
                $('.wasabi-setting').addClass('d-none');
                $('.local-setting').addClass('d-none');
            }else if($(this).val() == 'wasabi'){
                $('.s3-setting').addClass('d-none');
                $('.wasabi-setting').removeClass('d-none');
                $('.local-setting').addClass('d-none');
            }else{
                $('.s3-setting').addClass('d-none');
                $('.wasabi-setting').addClass('d-none');
                $('.local-setting').removeClass('d-none');
            }
        });
    
</script>

@endpush
