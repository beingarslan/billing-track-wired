<div class="form-group">
	<div class="card">
		<div class="card-header h3">@lang('bt.acl_roles')
		</div>
		<div class="card-body">
				<div class="table-responsive">
				<table id="roles" class="table table-striped table-hover table-sm compact bt-nowrap bt-acl-table">
					<thead>
					<tr>
						<th>@lang('bt.id')</th>
						<th>@lang('bt.name')</th>
						<th>@lang('bt.description')</th>
						<th>@lang('bt.acl_guard_name')</th>
						<th>@lang('bt.created')</th>
						<th>@lang('bt.updated')</th>
						<th>@lang('bt.action')</th>
					</tr>
					</thead>
					<tbody>
					@foreach($roles as $role)
						<tr>
							<td>{{ $role->id }}</td>
							<td>{{ $role->name }}</td>
							<td>{{ $role->description }}</td>
							<td>{{ $role->guard_name }}</td>
							<td>{{ $role->created_at->toFormattedDateString() }}</td>
							<td>{{ $role->updated_at->toFormattedDateString() }}</td>
						<td><input type="checkbox" class="form-check-input" name="roles[]" id="{{ $role->id }}" value="{{ $role->id }}"
								   @if(!isset($user) && $role->name == $userType) checked @endif
								   @if(isset($user) && $user->hasRole($role->name)) checked @endif
								   @if(isset($user) && !$user->hasRole('superadmin') && $role->name == 'superadmin') disabled @endif>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
