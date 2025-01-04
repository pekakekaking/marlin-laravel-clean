<div class="w-fullbg-white rounded-lg border p-1 md:p-3 m-10">
    <h3 class="font-semibold p-1">Discussion</h3>
    <div class="flex flex-col gap-5 m-3">
        @foreach($post['comments'] as $comment)

            <!-- Comment Container -->
            @if($comment['parent_id']==null)
                <div>
                    <div class="flex w-full justify-between border rounded-md">

                        <div class="p-3">
                            <div class="flex gap-3 items-center">
                                <h3 class="font-bold">
                                    {{$comment['user']['name']}}
                                    <br>
                                    <span class="text-sm text-gray-400 font-normal">{{$comment['user']['email']}}</span>
                                </h3>
                            </div>
                            <p class="text-gray-600 mt-2">
                                {{$comment['content']}}
                            </p>
                            <button class="text-right text-blue-500">Reply</button>
                        </div>


                        <div class="flex flex-col items-end gap-3 pr-3 py-3">
                            <div>
                                <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke-width="5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M4.5 15.75l7.5-7.5 7.5 7.5"/>
                                </svg>
                            </div>
                            <div>
                                <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke-width="5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                </svg>
                            </div>
                        </div>

                    </div>

                    @endif


                    <!-- Reply Container  -->
                    @foreach($post['comments'] as $replyComment)
                        @if (isset($replyComment['parent_id']) && $replyComment['parent_id']==$comment['id'])
                            <div class="text-gray-300 font-bold pl-14">|</div>
                            <div class="flex justify-between border ml-5  rounded-md">

                                <div class="p-3">
                                    <div class="flex gap-3 items-center">
                                        <h3 class="font-bold">
                                            {{$replyComment['user']['name']}}
                                            <br>
                                            <span class="text-sm text-gray-400 font-normal">{{$replyComment['user']['email']}}</span>
                                        </h3>
                                    </div>
                                    <p class="text-gray-600 mt-2">
                                        {{$replyComment['content']}}
                                    </p>
                                </div>
                            </div>


                </div>
                <!-- END Reply Container  -->

            @endif
        @endforeach
    </div>
    <!-- END Comment Container  -->

    @endforeach


</div>


<div class="w-full px-3 mb-2 mt-6">
        <textarea
                class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-400 focus:outline-none focus:bg-white"
                name="body" placeholder="Comment" required></textarea>

</div>