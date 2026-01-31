<x-filament-panels::page>
    <style>
      
      .sub-title{
        font-size: 20px;
        font-weight: 700;
        color: #333;
      }
      
        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 25px;
            max-width: 1200px;
            width: 100%;
        }

        /* Basic Stat Card */
        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .stat-icon.users {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .stat-icon.revenue {
            background: linear-gradient(135deg, #4CAF50, #8BC34A);
        }

        .stat-icon.orders {
            background: linear-gradient(135deg, #FF9800, #FF5722);
        }

        .stat-icon.growth {
            background: linear-gradient(135deg, #9C27B0, #E91E63);
        }

        .stat-info h3 {
            font-size: 14px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            line-height: 1.2;
        }

        .stat-change {
            display: flex;
            align-items: center;
            font-size: 14px;
            font-weight: 600;
            margin-top: 5px;
        }

        .change-up {
            color: #4CAF50;
        }

        .change-down {
            color: #F44336;
        }

        .stat-change i {
            margin-right: 5px;
        }

        .stat-footer {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            font-size: 13px;
            color: #777;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .trend-indicator {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .trend-up {
            background: rgba(76, 175, 80, 0.1);
            color: #4CAF50;
        }

        .trend-down {
            background: rgba(244, 67, 54, 0.1);
            color: #F44336;
        }
    </style>
    <!--  Job seeker by country -->
    <h1 class="sub-title">Job Seekers By Country</h1>
    <div class="dashboard-container">
        @foreach($jobSeekerByCountry as $key => $item)
            @if($key == '')
            @continue
            @endif
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-info">
                        <h3>{{ App\Enums\Users\CountryEnum::from($key)->getLabel() }}</h3>
                        <div class="stat-value">{{ $item }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!--  Job seeker by industry -->
    <h1 class="sub-title">Job Seekers By Industry</h1>
    <div class="dashboard-container">
        @foreach($jobSeekerByIndustry as $key => $item)
            @if($key == '')
            @continue
            @endif
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-info">
                        <h3>{{ App\Enums\Users\IndustryEnum::from($key)->getLabel() }}</h3>
                        <div class="stat-value">{{ $item }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!--  Job seeker by experience -->
    <h1 class="sub-title">Job Seekers By Experience</h1>
    <div class="dashboard-container">
        @foreach($jobSeekerByExperience as $key => $item)
            @if($key == '')
            @continue
            @endif
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-info">
                        <h3>{{ App\Enums\Users\ExperienceLevelEnum::from($key)->getLabel() }}</h3>
                        <div class="stat-value">{{ $item }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-filament-panels::page>