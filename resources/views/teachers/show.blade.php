@extends('layouts.app')

@section('title', 'Docente '.$teacher->user->name)
<!--css-->
@push('css')
    <style>
        body {
        background-color: #f8f8f6;
        font-family: "Segoe UI", sans-serif;
        color: #333;
        }

        /* ====== LEFT COLUMN ====== */
        .doctor-photo {
        border-radius: 12px;
        width: 100%;
        object-fit: cover;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-info i {
        color: #6c757d;
        margin-right: 6px;
        }

        /* ====== MIDDLE COLUMN ====== */
        .rating-box {
        background-color: #f9f9f5;
        border-radius: 10px;
        padding: 1rem;
        display: inline-block;
        text-align: center;
        }

        .rating-score {
            font-size: 2rem;
            font-weight: bold;
            color: #75c227;
        }

        .rating-stars {
        color: #ffc107;
        }

        .ai-summary {
            background-color: #f3f3ee;
            border-left: 4px solid #d4e157;
            padding: 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .visit-reasons .progress {
        height: 8px;
        border-radius: 4px;
        }

        .activity-bar {
        height: 12px;
        border-radius: 6px;
        margin-bottom: 6px;
        }

        /* ====== RIGHT COLUMN ====== */
        .appointment-box {
        background-color: #fffef9;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        }

        .appointment-box h5 {
        font-weight: 700;
        margin-bottom: 1rem;
        }

        .day-buttons .btn,
        .time-buttons .btn {
        border-radius: 8px;
        font-size: 0.9rem;
        margin: 0.25rem;
        }

        .day-buttons .btn.active,
        .time-buttons .btn.active {
        background-color: #212529;
        color: #fff;
        }

        .book-now {
        background-color: #e6ee00;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        width: 100%;
        padding: 0.75rem;
        transition: background 0.3s;
        }

        .book-now:hover {
        background-color: #d4e157;
        }

        /* ====== RESPONSIVE ====== */
        @media (max-width: 991px) {
        .rating-box {
            margin-top: 1rem;
        }
        .appointment-box {
            margin-top: 2rem;
        }
        }

        .titles-list {
            column-count: 3; /* 2 columnas */
            column-gap: 1.5rem; /* espacio entre columnas */
        }

        @media (max-width: 768px) {
            .titles-list {
                column-count: 1; /* en móvil, una sola columna */
            }
        }

  </style>
@endpush
@section('content')
    <div class="container-fluid px-4">
        <div class="row g-4">
            <!-- LEFT COLUMN: PHOTO + CONTACT -->
                <div class="col-lg-3 text-center">
                    @if (!empty(auth()->user()->avatar_route))
                        <img src="{{ Storage::url($teacher->user->avatar_route) }}" alt="Perfil del Docente" class="doctor-photo mb-4" />
                    @else
                        <img src="{{ asset('build/assets/img/user.png') }}" alt="Perfil del Docente" class="doctor-photo mb-4" />
                    @endif
                    <div class="profile-info text-start d-inline-block">
                        <p class="mb-1"><i class="fa-solid fa-location-dot" style="margin-right: 10px;"></i>Colombia</p>
                        <p class="mb-1"><i class="fa-solid fa-phone" style="margin-right: 10px;"></i>{{ $teacher->user->contact_number }} -- {{ $teacher->second_phone }}</p>
                        <p class="mb-1"><i class="fa-solid fa-envelope" style="margin-right: 10px;"></i>{{ $teacher->user->email }} -- {{ $teacher->second_email }}</p>
                        <p class="mb-1"><i class="fa-solid fa-language" style="margin-right: 10px;"></i>Español (Nativo)</p>
                        @if($teacher->linkedin != '')
                            <hr>
                            <a href="{{ $teacher->linkedin }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fa-brands fa-linkedin" style="margin-right: 10px;"></i>
                                Linkedin
                            </a>
                        @endif
                    </div>
                </div>

        <!-- MIDDLE COLUMN: PROFILE DETAILS -->
        <div class="col-lg-8">
            <h3 class="fw-bold">Dcte. {{ $teacher->user->name }}</h3>
            <p class="text-muted mb-3">{{ $teacher->professional_title }}</p>

           <div class="d-flex align-items-start mb-4">
                <div class="rating-box me-3">
                    <div class="rating-score"><i class="fa-solid fa-user-graduate"></i></div>
                    <small class="text-dark">{{ count($teacher->additional_titles) + 1 }} Títulos</small>
                </div>                

                <div class="titles-list mt-3">
                    @foreach ($teacher->additional_titles as $title)
                        <div class="mb-1">
                            <span class="me-2">{{ $title->title }}</span>
                            <strong>{{ $title->graduation_year }}</strong>
                        </div>
                    @endforeach
                </div>
            </div>

            <h5 class="fw-bold mb-3">Lineas de Investigación</h5>
            <div class="ai-summary mb-4">
                <strong>{{ $teacher->research_lines }}</strong>
            </div>

            <h5 class="fw-bold mb-3">Professional Activities</h5>
            <div class="ai-summary mb-4" style="border-left: 4px solid #7c2a8e; Background-color: #5b1d6f21;">
                <ul>
                    @foreach ($teacher->assigned_subjects as $assigned)
                        <li>{{ $assigned }}</li>
                    @endforeach
                </ul>
            </div>
      </div>
    </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        
    </script>
@endpush
