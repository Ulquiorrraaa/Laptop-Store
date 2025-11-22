@extends('layouts.app')

@section('title', 'Manage Users - Admin')

@section('content')
 <link rel="stylesheet" href="{{ asset('css/admin/users/index.css') }}">

<div class="page-header">
    <h1>👥 Manage Users</h1>
    <div style="color: #6c757d;">
        Total Users: <strong>{{ $users->total() }}</strong>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>Customer Profile</th>
                    <th>Contact Phone</th>
                    <th>Joined Date</th>
                    <th>Total Orders</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td style="color: #999; font-weight: 500;">#{{ $user->id }}</td>
                    
                    <td>
                        <div class="user-profile">
                            <div class="avatar-circle">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="user-info">
                                <span class="user-name">{{ $user->name }}</span>
                                <span class="user-email">{{ $user->email }}</span>
                            </div>
                        </div>
                    </td>
                    
                    <td>{{ $user->phone ?? 'N/A' }}</td>
                    
                    <td style="color: #7f8c8d;">
                        {{ $user->created_at->format('M d, Y') }}
                    </td>
                    
                    <td>
                        <span class="order-count-badge">
                            {{ $user->orders()->count() }} Orders
                        </span>
                    </td>
                    
                    <td style="text-align: right;">
                        <form action="/admin/users/{{ $user->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user? All their order history will be lost.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">
                                🗑️ Delete User
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 3rem;">
                        <p style="color: #999; font-size: 1.1rem;">No registered customers found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($users->hasPages())
        <div style="padding: 1.5rem; border-top: 1px solid #f1f1f1;">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection