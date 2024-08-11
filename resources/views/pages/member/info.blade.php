@extends('layouts/contentNavbarLayout')

@section('title', 'Member - Info')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">내정보 /</span> 내정보 관리
    </h4>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('member.update.basic') }}" method="POST">
                @csrf
                <div class="card mb-4">
                    <h5 class="card-header">기본정보</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="member_id" class="form-label">아이디</label>
                            <input type="text" class="form-control" id="member_id" name="member_id" value="{{ old('member_id', $member->member_id) }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">이름</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $member->name) }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="created_at" class="form-label">가입일자</label>
                            <input type="text" class="form-control" id="created_at" name="created_at" value="{{ old('created_at', $member->created_at->format('Y-m-d')) }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">모집인 ID</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $recruiter ? $recruiter->member_id : '정보 없음') }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">연락처</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $member->phone) }}" required>

                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">이메일</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $member->email) }}" required>

                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">저장</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6">
            <form action="{{ route('member.update.account') }}" method="POST">
                @csrf
                <div class="card mb-4">
                    <h5 class="card-header">계좌정보</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="bank_code" class="form-label">은행명</label>
                            <select class="form-select @error('bank_code') is-invalid @enderror" id="bank_code" name="bank_code" required>
                                <option value="">은행을 선택하세요</option>
                                @foreach($bankList as $code => $bank)
                                    <option value="{{ $code }}" {{ old('bank_code', $account ? $account->bank_code : '') == $code ? 'selected' : '' }}>
                                        {{ $bank }}
                                    </option>
                                @endforeach
                            </select>
                            @error('bank_code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="account_number" class="form-label">계좌번호</label>
                            <input type="text" class="form-control @error('account_number') is-invalid @enderror" id="account_number" name="account_number" value="{{ old('account_number', $account ? $account->account_number : '') }}" required>
                            @error('account_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="account_name" class="form-label">예금주</label>
                            <input type="text" class="form-control @error('account_name') is-invalid @enderror" id="account_name" name="account_name" value="{{ old('account_name', $account ? $account->account_name : '') }}" required>
                            @error('account_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">저장</button>
                    </div>
                </div>
            </form>

            <form action="{{ route('member.update.password') }}" method="POST">
                @csrf
                <div class="card mb-4">
                    <h5 class="card-header">비밀번호 변경</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">현재 비밀번호</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                            @error('current_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">새 비밀번호</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required>
                            @error('new_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">새 비밀번호 확인</label>
                            <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="new_password_confirmation" name="new_password_confirmation" required>
                            @error('new_password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">비밀번호 변경</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection