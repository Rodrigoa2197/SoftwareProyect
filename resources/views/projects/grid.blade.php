@php
$logo_path = \App\Models\Utility::get_file('/');
@endphp
@if(isset($projects) && !empty($projects) && count($projects) > 0)
    @foreach ($projects as $key => $project)
        <div class="col-xl-4 col-lg-4 col-sm-6">
            <div class="card hover-shadow-lg">
                <div class="card-header border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0 {{ (strtotime($project->end_date) < time()) ? 'text-danger' : '' }}" data-toggle="tooltip" data-original-title="{{__('End Date')}}">{{ \App\Models\Utility::getDateFormated($project->end_date) }}</h6>
                        </div>
                        <div class="text-right">
                            <span class="badge badge-xs badge-{{ (\Auth::user()->checkProject($project->id) == 'Owner') ? 'success' : 'warning'  }}" data-toggle="tooltip" data-original-title="{{__('You are ') .__(ucfirst($project->permission()))}}">{{ \Auth::user()->checkProject($project->id) }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('projects.show',$project) }}" class="avatar rounded-circle avatar-lg hover-translate-y-n3">
                        @if($project->image)

                        <img src="{{$logo_path.$project->image}}" alt="{{ $project->name }}"  class="avatar avatar-xl fix_size_show_img" id="blah" />
                        @else

                       <img {{ $project->img_image }} title="{{ $project->name }}">
                        @endif
                    </a>
                    <h5 class="h6 my-4">
                        <a href="{{ route('projects.show',$project) }}">{{ $project->name }}</a> <br>
                    </h5>
                    <div class="avatar-group hover-avatar-ungroup mb-3" id="project_{{ $project->id }}">
                        @if(isset($project->users) && !empty($project->users) && count($project->users) > 0)
                            @foreach($project->users as $key => $user)
                                @if($key < 3)
                                    <a href="#" class="avatar rounded-circle avatar-sm">
                                        @if($user->avatar)
                                            <img src="{{$logo_path.$user->avatar}}" alt="{{ $user->name }}"  class="" />
                                        @else
                                            <img {{ $user->img_avatar }} title="{{ $user->name }}">
                                        @endif
                                    </a>
                                @else
                                    @break
                                @endif
                            @endforeach
                            @if(count($project->users) > 3)
                                <a href="#" class="avatar rounded-circle avatar-sm">
                                    <img avatar="+ {{ count($project->users)-3 }}">
                                </a>
                            @endif
                        @endif
                    </div>
                    <span class="clearfix"></span>
                    <span class="badge badge-pill badge-{{\App\Models\Project::$status_color[$project->status]}}">{{ __(\App\Models\Project::$status[$project->status]) }}</span>
                </div>
                <div class="progress w-100 height-2">
                    <div class="progress-bar bg-{{ $project->project_progress()['color'] }}" role="progressbar" aria-valuenow="{{ $project->project_progress()['percentage'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $project->project_progress()['percentage'] }};"></div>
                </div>
                <div class="card-footer">
                    @if(\Auth::user()->checkProject($project->id) == 'Owner')
                        <div class="actions d-flex justify-content-between px-4">
                            <a href="#" data-url="{{ route('invite.project.member.view', $project->id) }}" data-ajax-popup="true" data-size="lg" data-title="{{__('Invite Member')}}" class="action-item" data-toggle="tooltip" data-original-title="{{__('Invite Member')}}">
                                <i class="fas fa-paper-plane"></i>
                            </a>
                            <a href="{{ route('projects.edit',$project) }}" class="action-item" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="action-item text-danger" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?')}}|{{__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-project-{{$project->id}}').submit();">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['projects.destroy',$project->id],'id'=>'delete-project-'.$project->id]) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-xl-12 col-lg-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h6 class="text-center mb-0">{{__('No Projects Found.')}}</h6>
            </div>
        </div>
    </div>
@endif
