<div class="space">
    <div class="contaion">
        <h1>Request Status({{ $all_request }})</h1>

        <div class="modal_cancel" id='modal_cancel' wire:ignore.self>
            <div class="modal_content">
                <div class="header">
                    <i class='bx bxs-x-circle icon' ></i>
                    <h2>Cancel Request</h2>
                </div>
                <div class="body">
                    <p>Do you confirm to cancel the request?</p>
                    <table>
                        <tr class="input_field">
                            <td><label>Employee id</label></td>
                            <td><input type="text" wire:model.live='employee_id'></td>
                        </tr>
                        <tr class="input_field">
                            <td><label>Password</label></td>
                            <td><input type="password" wire:model.live='password'></td>
                        </tr>
                    </table>
                </div>
                @error('password')
                    <label class="err password">*</label>
                @enderror
                @error('employee_id')
                    <label class="err employee">*</label>
                @enderror
                <div class="footer">
                    <button id="close_modal" wire:click='clear_pass'>Close</button>
                    <button class="cancel_btn" wire:click='confirm_cancel'>Confirm</button>
                </div>
            </div>
        </div>



        <div class="header_content">
            <div class="dropdown" id='status_dropdown'>
                @if ($search_status == 'Approve')
                    <label class="header">
                        <div class="approve"></div>{{ $search_status }}
                    </label>
                @elseif($search_status == 'All')
                    <label class="header">
                        <div class="all"></div>All Status
                    </label>
                @elseif($search_status == 'Waiting')
                    <label class="header">
                        <div class="wait"></div>{{ $search_status }}
                    </label>
                @elseif($search_status == 'Reject')
                    <label class="header">
                        <div class="reject"></div>{{ $search_status }}
                    </label>
                @else
                    <label class="header">
                        <div class="null_st"></div>{{ $search_status }}
                    </label>
                @endif
                <i class='bx bx-chevron-down icon'></i>
                <div class="dropdown_list">
                    <ul style="list-style-type:none;">
                        <li wire:click='change_status("All")'>
                            <div class="all"></div>All Status
                        </li>
                        <li wire:click='change_status("Approve")'>
                            <div class="approve"></div>Approve
                        </li>
                        <li wire:click='change_status("Waiting")'>
                            <div class="wait"></div>Waiting
                        </li>
                        <li wire:click='change_status("Reject")'>
                            <div class="reject"></div>Reject
                        </li>
                    </ul>
                </div>
            </div>

            <div class="dropdown">
                @if ($search_action == 'All')
                    <label class="header">All Action</label>
                @else
                    <label class="header">{{ $search_action }}</label>
                @endif
                <i class='bx bx-chevron-down icon'></i>
                <div class="dropdown_list">
                    <ul style="list-style-type:none;">
                        <li wire:click='change_action("All")'>All Action</li>
                        <li wire:click='change_action("Insert")'>Insert</li>
                        <li wire:click='change_action("Upsert")'>Upsert</li>
                        <li wire:click='change_action("Update")'>Update</li>
                    </ul>
                </div>
            </div>
            <div>
                <label class="title_search">Start :</label>
                <input type="datetime-local" class="datetime" wire:model.live='start'>
            </div>
            <div>
                <label class="title_search">End :</label>
                <input type="datetime-local" class="datetime" wire:model.live='end'>
            </div>
            <div>
                <label class="title_search">Search </label>
                <input type="text" class="search_input" placeholder="Search..." wire:model.live='search'>
            </div>
        </div>



        @if (count($requesr_detail) == 0)
            <div class="not_found">
                <img src="/assets/image/not_found.jpg">
                <h2>Not Found</h2>
            </div>
        @endif

        @foreach ($requesr_detail as $detail)
            @if ($detail->spec_id != 0)
                @if ($detail->status != 0)
                    <div class="request_field">
                        <table>
                            <tr >
                                @if ($detail->status == 0)
                                    <td class="status wait"></td>
                                @elseif($detail->status == 1)
                                    <td class="status success"></td>
                                @else
                                    <td class="status cancel"></td>
                                @endif
                                <td class="user">{{ $detail->regis_user_id }}</td>
                                <td class="detail">Update spec information in id number {{ $detail->spec_id }}.
                                </td>
                                <td class="time_rq">Request : {{ $detail->request_time }}</td>
                                <td class="time_app">Approve : {{ $detail->approve_time }}</td>
                            </tr>
                        </table>
                    </div>
                @else
                    <div class="update_detail">
                        <div class="request_field" wire:click='rq_id({{ $detail->id }})'>
                            <table>
                                <tr>
                                    @if ($detail->status == 0)
                                        <td class="status wait"></td>
                                    @elseif($detail->status == 1)
                                        <td class="status success"></td>
                                    @else
                                        <td class="status cancel"></td>
                                    @endif
                                    <td class="user">{{ $detail->regis_user_id }}</td>
                                    <td class="detail">Update spec information in id number
                                        {{ $detail->spec_id }}.
                                    </td>
                                    <td class="time_app">Approve : Waiting...</td>
                                    <td class="time_rq">Request : {{ $detail->request_time }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endif
            @elseif($detail->group != 0 and $detail->action == 2)
                @if ($detail->status != 0)
                    <div class="request_field">
                        <table>
                            <tr>
                                @if ($detail->status == 0)
                                    <td class="status wait"></td>
                                @elseif($detail->status == 1)
                                    <td class="status success"></td>
                                @else
                                    <td class="status cancel"></td>
                                @endif
                                <td class="user">{{ $detail->regis_user_id }}</td>
                                <td class="detail">Request to upsert spec with excel file </td>
                                <td class="time_app">Approve : {{ $detail->approve_time }}</td>
                                <td class="time_rq">Request : {{ $detail->request_time }}</td>
                            </tr>
                        </table>
                    </div>
                @else
                    <div class="upsert_detail">
                        <div class="request_field" wire:click='rq_id({{ $detail->id }})'>
                            <table>
                                <tr>
                                    @if ($detail->status == 0)
                                        <td class="status wait"></td>
                                    @elseif($detail->status == 1)
                                        <td class="status success"></td>
                                    @else
                                        <td class="status cancel"></td>
                                    @endif
                                    <td class="user">{{ $detail->regis_user_id }}</td>
                                    <td class="detail">Request to upsert spec with excel file </td>
                                    <td class="time_app">Approve : Waiting...</td>
                                    <td class="time_rq">Request : {{ $detail->request_time }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endif
            @elseif($detail->group != 0 and $detail->action == 1)
                @if ($detail->status != 0)
                    <div class="request_field">
                        <table>
                            <tr>
                                @if ($detail->status == 0)
                                    <td class="status wait"></td>
                                @elseif($detail->status == 1)
                                    <td class="status success"></td>
                                @else
                                    <td class="status cancel"></td>
                                @endif
                                <td class="user">{{ $detail->regis_user_id }}</td>
                                <td class="detail">Request to insert spec with excel file </td>
                                <td class="time_rq">Request : {{ $detail->request_time }}</td>
                                <td class="time_app">Approve : {{ $detail->approve_time }}</td>
                            </tr>
                        </table>
                    </div>
                @else
                    <div class="insert_file_detail" id="insert_file_detail">
                        <div class="request_field" wire:click='rq_id({{ $detail->id }})'>
                            <table>
                                <tr>
                                    @if ($detail->status == 0)
                                        <td class="status wait"></td>
                                    @elseif($detail->status == 1)
                                        <td class="status success"></td>
                                    @else
                                        <td class="status cancel"></td>
                                    @endif
                                    <td class="user">{{ $detail->regis_user_id }}</td>
                                    <td class="detail">Request to insert spec with excel file </td>
                                    <td class="time_app">Approve : Waiting...</td>
                                    <td class="time_rq">Request : {{ $detail->request_time }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endif
            @else
                @if ($detail->status != 0)
                    <div class="request_field">
                        <table>
                            <tr>
                                @if ($detail->status == 0)
                                    <td class="status wait"></td>
                                @elseif($detail->status == 1)
                                    <td class="status success"></td>
                                @else
                                    <td class="status cancel"></td>
                                @endif
                                <td class="user">{{ $detail->regis_user_id }}</td>
                                <td class="detail">Request to insert new spec </td>
                                <td class="time_rq">Request : {{ $detail->request_time }}</td>
                                <td class="time_app">Approve : {{ $detail->approve_time }}</td>
                            </tr>
                        </table>
                    </div>
                @else
                    <div class="insert_detail" id="insert_detail">
                        <div class="request_field" wire:click='rq_id({{ $detail->id }})'>
                            <table>
                                <tr>
                                    @if ($detail->status == 0)
                                        <td class="status wait"></td>
                                    @elseif($detail->status == 1)
                                        <td class="status success"></td>
                                    @else
                                        <td class="status cancel"></td>
                                    @endif
                                    <td class="user">{{ $detail->regis_user_id }}</td>
                                    <td class="detail">Request to insert new spec </td>

                                    <td class="time_app">Approve : Waiting...</td>
                                    <td class="time_rq">Request : {{ $detail->request_time }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endif
            @endif

        @endforeach
    </div>
</div>
