<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email | HerPlay</title>
    <style>
        .hp-page,
        .hp-page * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
        }

        .hp-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
            background: #e9f1ee;
            font-family: -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
            color: #0f2f44;
        }

        .hp-card {
            width: 100%;
            max-width: 460px;
            background: #ffffff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 18px 50px rgba(15, 47, 68, 0.14);
        }

        .hp-top {
            background: #f5fbf9;
            text-align: center;
            padding: 30px 24px 22px;
        }

        .hp-brand {
            font-size: 36px;
            font-weight: 700;
            line-height: 1;
            letter-spacing: 1px;
            color: #0f2f44;
        }

        .hp-brand span {
            color: #17a34a;
        }

        .hp-tag {
            margin-top: 10px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 6px;
            text-transform: uppercase;
            color: #0f2f44;
        }

        .hp-hero {
            background: #0f2f44;
            border-top: 4px solid #17a34a;
            padding: 28px 32px 30px;
            text-align: center;
        }

        .hp-icon {
            width: 54px;
            height: 54px;
            margin: 0 auto 16px;
            border-radius: 50%;
            background: rgba(74, 222, 128, 0.14);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hp-icon svg {
            width: 26px;
            height: 26px;
        }

        .hp-hero h1 {
            margin: 0;
            font-size: 24px;
            line-height: 1.3;
            font-weight: 700;
            color: #ffffff;
        }

        .hp-hero p {
            margin: 10px 0 0;
            font-size: 14px;
            line-height: 1.7;
            color: #a9bfcd;
        }

        .hp-hero p b {
            color: #4ade80;
            word-break: break-all;
        }

        .hp-body {
            padding: 30px 32px 34px;
        }

        .hp-alert {
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 22px;
        }

        .hp-alert-ok {
            background: #e8f7ee;
            border: 1px solid #bfe5cd;
            color: #146c35;
        }

        .hp-alert-err {
            background: #fdecec;
            border: 1px solid #f5c2c2;
            color: #a12020;
        }

        .hp-alert ul {
            margin: 0;
            padding-left: 18px;
        }

        .hp-label {
            display: block;
            text-align: center;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #17a34a;
            margin-bottom: 14px;
        }

        .hp-boxes {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .hp-box {
            width: 50px;
            height: 60px;
            border: 2px solid #d3e3db;
            border-radius: 12px;
            background: #f8fcfa;
            text-align: center;
            font-size: 26px;
            font-weight: 700;
            font-family: "Courier New", Courier, monospace;
            color: #0f2f44;
            outline: none;
            transition: border-color .15s, box-shadow .15s, background .15s;
            padding: 0;
        }

        .hp-box:focus {
            border-color: #17a34a;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(23, 163, 74, 0.16);
        }

        .hp-box.hp-filled {
            border-color: #0f2f44;
            background: #ffffff;
        }

        .hp-box.hp-error {
            border-color: #e24d4d;
            background: #fff7f7;
        }

        .hp-hint {
            margin: 14px 0 0;
            text-align: center;
            font-size: 13px;
            color: #6b8190;
        }

        .hp-hint b {
            color: #17a34a;
        }

        .hp-btn {
            display: block;
            width: 100%;
            margin-top: 24px;
            padding: 15px 18px;
            border: 0;
            border-radius: 12px;
            background: #17a34a;
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .3px;
            cursor: pointer;
            transition: background .15s, transform .05s;
        }

        .hp-btn:hover {
            background: #128a3e;
        }

        .hp-btn:active {
            transform: translateY(1px);
        }

        .hp-sep {
            height: 1px;
            background: #e3ebe8;
            margin: 26px 0 20px;
        }

        .hp-resend {
            text-align: center;
            font-size: 13px;
            color: #6b8190;
        }

        .hp-link-btn {
            margin-top: 6px;
            background: none;
            border: 0;
            padding: 6px 10px;
            font-size: 14px;
            font-weight: 700;
            color: #0f2f44;
            cursor: pointer;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .hp-link-btn:hover {
            color: #17a34a;
        }

        .hp-link-btn:disabled {
            color: #9fb0ba;
            text-decoration: none;
            cursor: not-allowed;
        }

        .hp-back {
            display: block;
            text-align: center;
            margin-top: 10px;
            font-size: 13px;
            color: #6b8190;
            text-decoration: none;
        }

        .hp-back:hover {
            color: #0f2f44;
            text-decoration: underline;
        }

        .hp-foot {
            background: #0b2233;
            text-align: center;
            padding: 16px 20px;
            font-size: 11px;
            color: #6f879a;
            line-height: 1.6;
        }

        .hp-shake {
            animation: hp-shake .35s;
        }

        @keyframes hp-shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-6px);
            }

            40%,
            80% {
                transform: translateX(6px);
            }
        }

        @media (max-width: 420px) {

            .hp-hero,
            .hp-body {
                padding-left: 20px;
                padding-right: 20px;
            }

            .hp-hero h1 {
                font-size: 21px;
            }

            .hp-boxes {
                gap: 7px;
            }

            .hp-box {
                width: 44px;
                height: 54px;
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

    <div class="hp-page">
        <div class="hp-card">

            <div class="hp-top">
                <div class="hp-brand"><span>her</span>play</div>
                <div class="hp-tag">PS Rental</div>
            </div>

            <div class="hp-hero">
                <div class="hp-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                        <polyline points="3 7 12 13 21 7"></polyline>
                    </svg>
                </div>
                <h1>Cek email kamu</h1>
                <p>Kami kirim kode 6 angka ke<br><b>{{ $email }}</b></p>
            </div>

            <div class="hp-body">

                @if (session('success'))
                <div class="hp-alert hp-alert-ok">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                <div class="hp-alert hp-alert-err">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form id="hp-form" method="POST" action="{{ route('verification.verify') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="code" id="hp-code">

                    <span class="hp-label">Masukkan kode</span>

                    <div class="hp-boxes" id="hp-boxes">
                        @for ($i = 0; $i < 6; $i++)
                            <input
                            type="text"
                            class="hp-box {{ $errors->any() ? 'hp-error' : '' }}"
                            inputmode="numeric"
                            maxlength="1"
                            aria-label="Digit {{ $i + 1 }}"
                            @if ($i===0) autocomplete="one-time-code" autofocus @endif>
                            @endfor
                    </div>

                    <p class="hp-hint">Kode berlaku <b>10 menit</b></p>

                    <button type="submit" class="hp-btn">Verifikasi</button>
                </form>

                <div class="hp-sep"></div>

                <div class="hp-resend">
                    Belum dapat kode? Cek folder Spam, atau
                    <form method="POST" action="{{ route('verification.resend') }}" style="margin:0;">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <button type="submit" class="hp-link-btn" id="hp-resend" data-sisa="{{ $sisa }}">Kirim ulang kode</button>
                    </form>
                </div>

                <a href="{{ route('register') }}" class="hp-back">Salah email? Daftar ulang</a>

            </div>

            <div class="hp-foot">
                &copy; {{ date('Y') }} HerPlay. Jangan bagikan kode ini ke siapa pun.
            </div>

        </div>
    </div>

    <script>
        (function() {
            var boxes = Array.prototype.slice.call(document.querySelectorAll('.hp-box'));
            var hidden = document.getElementById('hp-code');
            var form = document.getElementById('hp-form');
            var wrap = document.getElementById('hp-boxes');

            function sync() {
                hidden.value = boxes.map(function(b) {
                    return b.value;
                }).join('');
                boxes.forEach(function(b) {
                    b.classList.toggle('hp-filled', b.value !== '');
                    b.classList.remove('hp-error');
                });
            }

            boxes.forEach(function(box, i) {
                box.addEventListener('input', function() {
                    box.value = box.value.replace(/\D/g, '').slice(-1);
                    sync();
                    if (box.value && i < boxes.length - 1) boxes[i + 1].focus();
                });

                box.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && !box.value && i > 0) {
                        e.preventDefault();
                        boxes[i - 1].value = '';
                        boxes[i - 1].focus();
                        sync();
                    } else if (e.key === 'ArrowLeft' && i > 0) {
                        boxes[i - 1].focus();
                    } else if (e.key === 'ArrowRight' && i < boxes.length - 1) {
                        boxes[i + 1].focus();
                    }
                });

                box.addEventListener('focus', function() {
                    box.select();
                });

                box.addEventListener('paste', function(e) {
                    e.preventDefault();
                    var text = (e.clipboardData || window.clipboardData).getData('text') || '';
                    text = text.replace(/\D/g, '').slice(0, boxes.length);
                    if (!text) return;
                    text.split('').forEach(function(c, k) {
                        boxes[k].value = c;
                    });
                    sync();
                    boxes[Math.min(text.length, boxes.length - 1)].focus();
                });
            });

            form.addEventListener('submit', function(e) {
                sync();
                if (hidden.value.length < boxes.length) {
                    e.preventDefault();
                    wrap.classList.remove('hp-shake');
                    void wrap.offsetWidth;
                    wrap.classList.add('hp-shake');
                    var empty = boxes.filter(function(b) {
                        return !b.value;
                    })[0];
                    if (empty) empty.focus();
                }
            });

            // Hitung mundur tombol kirim ulang
            var btn = document.getElementById('hp-resend');
            var sisa = parseInt(btn.dataset.sisa, 10) || 0;

            function tick() {
                if (sisa > 0) {
                    btn.disabled = true;
                    btn.textContent = 'Kirim ulang kode (' + sisa + ' dtk)';
                    sisa--;
                    setTimeout(tick, 1000);
                } else {
                    btn.disabled = false;
                    btn.textContent = 'Kirim ulang kode';
                }
            }
            tick();
        })();
    </script>

</body>

</html>