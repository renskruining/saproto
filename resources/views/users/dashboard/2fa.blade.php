<div class="panel panel-default">
    <div class="panel-heading">
        <strong>Two Factor Authentication</strong>
    </div>
    <div class="panel-body">

        <div class="row">

            <div class="col-md-6">

                @if($user->tfa_totp_key)

                    <p style="text-align: center;">
                        <strong>
                            Time-Based 2 Factor Authentication enabled.
                        </strong>
                    </p>

                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            <a href="{{ route('user::2fa::deletetimebased', ['user' => $user->id]) }}"
                               class="btn btn-danger">
                                Disable Time-Based 2FA
                            </a>
                        </div>
                    </div>

                @else

                    <p style="text-align: center;">
                        <strong>
                            No Time-Based 2 Factor Authentication configured.
                        </strong>
                    </p>

                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            <a href="{{ route('user::2fa::addtimebased', ['user' => $user->id]) }}"
                               class="btn btn-success">
                                Configure Time-Based 2FA
                            </a>
                        </div>
                    </div>

                @endif

            </div>

            <div class="col-md-6">

                @if($user->tfa_yubikey_identity)

                    <p style="text-align: center;">
                        <strong>
                            YubiKey configured.
                        </strong>
                    </p>

                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            <a href="{{ route('user::2fa::deleteyubikey', ['user' => $user->id]) }}"
                               class="btn btn-danger">
                                Disable YubiKey 2FA
                            </a>
                        </div>
                    </div>

                @else

                    <p style="text-align: center;">
                        <strong>
                            No YubiKey configured.
                        </strong>
                    </p>

                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            <a href="{{ route('user::2fa::addyubikey', ['user' => $user->id]) }}"
                               class="btn btn-success">
                                Configure YubiKey 2FA
                            </a>
                        </div>
                    </div>

                @endif

            </div>

        </div>

    </div>

</div>