<div class="contact_area">
    <h2>أضف تعليق</h2>
    <form action="{{ route('storeComments') }}" method="post" class="contact_form">
        @csrf
        <input class="form-control" name="name" type="text" placeholder="الاسم*"
            @error('name') is-invalid @enderror value="{{ old('name') }}">
        <input class="form-control" name="email" type="email" placeholder="بريد الالكتروني*"
            @error('email') is-invalid @enderror value="{{ old('email') }}">
        <input class="form-control" name="title" type="text" placeholder="عنوان التعليق*"
            @error('title') is-invalid @enderror value="{{ old('title') }}">
        <textarea class="form-control" name="bio" cols="30" rows="10" placeholder="التعليق"
            @error('bio') is-invalid @enderror>{{ old('bio') }}</textarea>
        <input type="submit" value="ارسال" style="width:100%">
    </form>
</div>
