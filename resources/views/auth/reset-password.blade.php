@extends('layout.base')

@section('content')

<div class="container-wrap bg-light">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-auto">
				<h2 class="text-center fz-28">パスワードリセット</h2>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
				<form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <table class="table contacttable table-bordered tbl-2column fz-14 mt-32 mt-md-48">
						<tbody>
							<tr>
								<th scope="row">メールアドレス</th>
								<td colspan="2">
                                    <x-input id="email" class="form-control w-100" type="email" name="email" :value="old('email')" style="ime-mode: active; width:84%;" autocomplete="off" required />
                                    <span id="mail-error" class="d-block text-danger ml-24 lh-32"></span>
								</td>
							</tr>
							<tr>
								<th scope="row">パスワード</th>
								<td colspan="2">
                                    <x-input id="password" class="form-control w-100"
                                                type="password"
                                                name="password"
                                                style=" width:84%;"
                                                required autocomplete="new-password" />
                                    <span id="password-error" class="d-block text-danger ml-24 lh-32"></span>
                                </td>
							</tr>
							<tr>
								<th scope="row">パスワード（確認用）</th>
								<td colspan="2">
                                    <x-input id="password_confirmation" class="form-control w-100"
                                                type="password"
                                                style="width:84%;"
                                                name="password_confirmation" required />
                                    <span id="password_confirmation-error" class="d-block text-danger ml-24 lh-32"></span>
                                </td>
							</tr>
						</tbody>
					</table>
                    <div class="send text-center my-40">
                        <input id="submit" class="px-40 py-16 bg-mizuiro text-white" style="border: 0px;" type="submit" value="送信する" />
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
@endsection

