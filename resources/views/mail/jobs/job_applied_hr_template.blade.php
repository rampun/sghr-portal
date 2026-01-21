<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Received - {{ config('app.name') }}</title>
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #374151;
            background-color: #f9fafb;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Header */
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 32px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .header-gradient {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        }

        .header-icon {
            width: 80px;
            height: 80px;
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            backdrop-filter: blur(4px);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .header-icon svg {
            width: 40px;
            height: 40px;
            fill: white;
        }

        .email-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 12px;
            position: relative;
        }

        .email-header p {
            font-size: 16px;
            opacity: 0.9;
            max-width: 480px;
            margin: 0 auto;
        }

        /* Content */
        .email-content {
            padding: 48px 32px;
            background-color: #ffffff;
        }

        .greeting {
            font-size: 18px;
            color: #4b5563;
            margin-bottom: 32px;
        }

        .greeting strong {
            color: #111827;
        }

        .confirmation-card {
            background: linear-gradient(135deg, #f0f4ff 0%, #fdf2f8 100%);
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 40px;
            border: 1px solid #e5e7eb;
        }

        .confirmation-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #10b981;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .confirmation-badge svg {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }

        .job-details {
            background-color: white;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #e5e7eb;
            margin-bottom: 32px;
        }

        .detail-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f3f4f6;
        }

        .detail-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .detail-icon {
            width: 24px;
            height: 24px;
            margin-right: 16px;
            color: #667eea;
            flex-shrink: 0;
        }

        .detail-content h4 {
            font-size: 14px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
        }

        .detail-content p {
            font-size: 16px;
            color: #111827;
            font-weight: 500;
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 24px;
            margin: 40px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, #667eea, #764ba2);
        }

        .timeline-item {
            position: relative;
            padding-bottom: 32px;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-dot {
            position: absolute;
            left: -29px;
            top: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background-color: #667eea;
            border: 3px solid white;
            box-shadow: 0 0 0 3px #e0e7ff;
        }

        .timeline-content {
            padding-left: 16px;
        }

        .timeline-content h4 {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
        }

        .timeline-content p {
            font-size: 14px;
            color: #6b7280;
        }

        .timeline-item.current .timeline-dot {
            background-color: #10b981;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        /* Actions */
        .actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin: 40px 0;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 16px 24px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            text-align: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background-color: white;
            color: #374151;
            border: 2px solid #e5e7eb;
        }

        .btn-secondary:hover {
            border-color: #667eea;
            color: #667eea;
        }

        /* Uploaded Files */
        .uploaded-files {
            background-color: #f9fafb;
            border-radius: 12px;
            padding: 24px;
            margin: 32px 0;
        }

        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px;
            background-color: white;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            margin-bottom: 12px;
            transition: transform 0.2s ease;
        }

        .file-item:hover {
            transform: translateX(4px);
            border-color: #667eea;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .file-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #e0e7ff 0%, #ede9fe 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
        }

        .file-details h4 {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
        }

        .file-details p {
            font-size: 12px;
            color: #6b7280;
        }

        /* Footer */
        .email-footer {
            background-color: #ffffff;
            padding: 32px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .footer-link {
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s ease;
        }

        .footer-link:hover {
            color: #667eea;
        }

        .copyright {
            font-size: 14px;
            color: #9ca3af;
            margin-top: 16px;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 24px;
        }

        .social-link {
            width: 36px;
            height: 36px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            text-decoration: none;
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }

        .social-link:hover {
            background-color: #667eea;
            color: white;
            border-color: #667eea;
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 640px) {
            .email-content {
                padding: 32px 20px;
            }

            .email-header {
                padding: 32px 20px;
            }

            .email-header h1 {
                font-size: 24px;
            }

            .confirmation-card {
                padding: 24px;
            }

            .actions {
                grid-template-columns: 1fr;
            }

            .footer-links {
                flex-direction: column;
                gap: 12px;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #111827;
            }

            .email-container {
                background-color: #1f2937;
                color: #f9fafb;
            }

            .job-details {
                /* background-color: #374151; */
                background-color: #ffffff;
                border-color: #4b5563;
            }

            .detail-content h4 {
                /* color: #d1d5db; */
                color: black;
            }

            .detail-content p {
                /* color: #f9fafb; */
                color: black;
            }

            .uploaded-files {
                background-color: #374151;
            }

            .file-item {
                background-color: #4b5563;
                border-color: #6b7280;
            }

            .email-footer {
                /* background-color: #374151; */
                background-color: #ffffff;
                border-color: #4b5563;
            }

            .social-link {
                background-color: #4b5563;
                border-color: #6b7280;
                color: #d1d5db;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <div class="header-gradient"></div>
            <div class="header-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                </svg>
            </div>
            <h1>Application Received!</h1>
            <p>A new application have been received for {{ $jobApplication->job->title }} at {{ $jobApplication->job->employer->name }}</p>
        </div>

        <!-- Main Content -->
        <div class="email-content">
            <!-- Job Details -->
            <div class="job-details">
                <h3 style="font-size: 18px; font-weight: 700; color: #111827; margin-bottom: 24px;">
                    Application Details
                </h3>

                <div class="detail-item">
                    <div class="detail-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                            <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                        </svg>
                    </div>
                    <div class="detail-content">
                        <h4>Position Applied</h4>
                        <p>{{ $jobApplication->job->title }}</p>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="detail-content">
                        <h4>Location</h4>
                        <p>{{ $jobApplication->job->location }}</p>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="detail-content">
                        <h4>Application Date</h4>
                        <p>{{ $jobApplication->created_at->format('F j, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="actions">
                <a href="{{ route('jobs.show', $jobApplication->job->id) }}" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    View Job Details
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <div style="margin-bottom: 24px;">
                <h3 style="font-size: 18px; font-weight: 700; color: #111827; margin-bottom: 12px;">
                    {{ config('app.name') }}
                </h3>
            </div>

            <div class="social-links">
                <a href="https://linkedin.com/company/{{ config('app.name') }}" class="social-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z" />
                        <rect x="2" y="9" width="4" height="12" />
                        <circle cx="4" cy="4" r="2" />
                    </svg>
                </a>
                <a href="https://twitter.com/{{ config('app.name') }}" class="social-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z" />
                    </svg>
                </a>
                <a href="https://facebook.com/{{ config('app.name') }}" class="social-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                    </svg>
                </a>
                <a href="https://instagram.com/{{ config('app.name') }}" class="social-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                    </svg>
                </a>
            </div>

            <p class="copyright">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.<br>
                <small>This is an automated message, please do not reply directly to this email.</small>
            </p>
        </div>
    </div>
</body>

</html>