@extends('layouts.default')
@section('title','店铺详情')
@section('content')

   <div class="container">

       <form action="{{route('shop.update',['shop'=>$shop])}}" method="POST">

           <div class="col-xs-6">
               <div class="form-group">
                   <label for="xxx">店铺图片</label><br>
                   <img src="{{$shop->shop_img}}" alt="" width="100px;">
               </div>
           </div>
           <div class="col-xs-6">
               <div class="form-group">
                   <label for="xxx">商品名称</label>
                   <input type="text" name="shop_name" class="form-control" id="xxx" placeholder="Email"  value="{{$shop->shop_name}}">
               </div>
           </div>
           <div class="col-xs-6">
               <div class="form-group">
                   <label for="xxx">商品评分</label>
                   <input type="text" name="shop_rating" class="form-control" id="xxx" placeholder="Email"  value="{{$shop->shop_rating}}">
               </div>
           </div>
           <div class="col-xs-6">
               <div class="form-group">
                   <label for="xxx">是否是品牌</label>
                   <label class="radio-inline">
                       <input type="radio" name="brand" {{$shop->brand==0?'checked':''}} id="inlineRadio1" value="0"> 使用
                   </label>
                   <label class="radio-inline">
                       <input type="radio" name="brand" id="inlineRadio2" value="1" {{$shop->brand==1?'checked':''}}> 不使用
                   </label>
               </div>
           </div>
           <div class="col-xs-6">
               <div class="form-group">
                   <label for="xxx">是否准时送达</label>
                   <label class="radio-inline">
                       <input type="radio" name="on_time" id="inlineRadio1" value="0" {{$shop->on_time==0?'checked':''}}> 使用
                   </label>
                   <label class="radio-inline">
                       <input type="radio" name="on_time" id="inlineRadio2" value="1" {{$shop->on_time==1?'checked':''}}> 不使用
                   </label>
               </div>
           </div>
           <div class="col-xs-6">
               <div class="form-group">
                   <label for="xxx">是否蜂鸟配送</label>
                   <label class="radio-inline">
                       <input type="radio" name="fengniao" id="inlineRadio1" value="0" {{$shop->fengniao==0?'checked':''}}> 使用
                   </label>
                   <label class="radio-inline">
                       <input type="radio" name="fengniao" id="inlineRadio2" value="1" {{$shop->fengniao==1?'checked':''}}> 不使用
                   </label>
               </div>
           </div>
           <div class="col-xs-6">
               <div class="form-group">
                   <label for="xxx">是否标记</label>
                   <label class="radio-inline">
                       <input type="radio" name="bao" id="inlineRadio1" value="0" {{$shop->bao==0?'checked':''}}> 使用
                   </label>
                   <label class="radio-inline">
                       <input type="radio" name="bao" id="inlineRadio2" value="1" {{$shop->bao==1?'checked':''}}> 不使用
                   </label>
               </div>
           </div>
           <div class="col-xs-6">
               <div class="form-group">
                   <label for="xxx">是否票记</label>
                   <label class="radio-inline">
                       <input type="radio" name="piao" id="inlineRadio1" value="0" {{$shop->piao==0?'checked':''}}> 使用
                   </label>
                   <label class="radio-inline">
                       <input type="radio" name="piao" id="inlineRadio2" value="1" {{$shop->piao==1?'checked':''}}> 不使用
                   </label>
               </div>
           </div>
           <div class="col-xs-6">
               <div class="form-group">
                   <label for="xxx">是否准准标记</label>
                   <label class="radio-inline">
                       <input type="radio" name="zhun" id="inlineRadio1" value="0" {{$shop->zhun==0?'checked':''}}> 使用
                   </label>
                   <label class="radio-inline">
                       <input type="radio" name="zhun" id="inlineRadio2" value="1" {{$shop->zhun==1?'checked':''}}> 不使用
                   </label>
               </div>
           </div>
           <div class="col-xs-6">
               <div class="form-group">
                   <label for="xxx">起送金额</label>
                   <input type="text" name="start_send" class="form-control" id="xxx" placeholder="Email"  value="{{$shop->start_send}}">
               </div>
           </div>
           <div class="col-xs-6">
               <div class="form-group">
                   <label for="xxx">配送费</label>
                   <input type="text" name="send_cost" class="form-control" id="xxx" placeholder="Email"  value="{{$shop->send_cost}}">
               </div>
           </div>
           <div class="col-xs-6">
               <div class="form-group">
                   <label for="xxx">预计时间</label>
                   <input type="text" name="estimate_time" class="form-control" id="xxx" placeholder="Email"  value="{{$shop->estimate_time}}">
               </div>
           </div>
           <div class="col-xs-6">
               <div class="form-group">
                   <label for="xxx">店公告</label>
                   <input type="text" name="notice" class="form-control" id="xxx" placeholder="Email"  value="{{$shop->notice}}">
               </div>
           </div>
           <div class="col-xs-6">
               <div class="form-group">
                   <label for="xxx">优惠信息</label>
                   <input type="text" name="discount" class="form-control" id="xxx" placeholder="Email"  value="{{$shop->discount}}">
               </div>
           </div>
           <div class="col-xs-6">
               <div class="form-group">
                   <label for="xxx">店铺分类</label>
                   <select class="form-control" name="category_id">
                       @foreach($categorys as $category)
                           <option  {{$category->id==$shop->id?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                       @endforeach
                   </select>
               </div>
           </div>

           <div class="col-xs-6">
               <div class="form-group">
                   <button class="btn btn-danger">提交</button>
               </div>
           </div>


           {{csrf_field()}}
           {{method_field('PUT')}}
       </form>

   </div>
@stop()

@section('js')
    <script>
        $("#jsx .btn-danger").click(function(){
            //二次确认
            if(confirm('确认删除该数据吗?删除后不可恢复!')){
                var tr = $(this).closest('tr');
                var id = tr.data('id');
                $.ajax({
                    type: "DELETE",
                    url: 'shop/'+id,
                    data: '_token={{ csrf_token() }}',
                    success: function(msg){
                        tr.fadeOut();
                    }
                });
                $(this).closest("tr").remove();
            }
        });
    </script>
@stop()

