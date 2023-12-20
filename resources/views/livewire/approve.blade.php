<div class="space">
    <div class="bg_modal_1" id="modal_update" wire:ignore.self>
        <div class="modal_content">
            <i class='bx bx-x icon' id="close_icon" wire:click='close_modal'></i>
            <h2>Approve request</h2>
            <label class="label_header">User id number @if (isset($new_data))
                    {{ $new_data->regis_user_id }} wants to update SPC spec number {{ $new_data->spec_id }}
                @endif. Do you want to approve it
                or
                not?</label>
            <div wire:loading wire:target="load_update" class="loading">
                <div class="loader"></div>
                <label>Loading..</label>
            </div>
            <div class="data_detail">
                <table>
                    <thead>
                        <tr>
                            <th>Column</th>
                            <th>Old Data</th>
                            <th>New Data</th>
                        </tr>
                    </thead>
                    @if (isset($old_data) and isset($new_data))
                        <tbody>
                            <tr>
                                <td>Process</td>
                                <td>{{ $old_data->process_name }}</td>
                                <td>{{ $new_data->process_name }}</td>
                            </tr>
                            <tr>
                                <td>Line</td>
                                <td>{{ $old_data->line_name }}</td>
                                <td>{{ $new_data->line_name }}</td>
                            </tr>
                            <tr>
                                <td>Machine</td>
                                <td>{{ $old_data->machine_name }}</td>
                                <td>{{ $new_data->machine_name }}</td>
                            </tr>
                            <tr>
                                <td>Partname</td>
                                <td>{{ $old_data->partname }}</td>
                                <td>{{ $new_data->partname }}</td>
                            </tr>
                            <tr>
                                <td>Parameter</td>
                                <td>{{ $old_data->param_name }}</td>
                                <td>{{ $new_data->param_name }}</td>
                            </tr>
                            <tr>
                                <td>Chart</td>
                                <td>{{ $old_data->chart_type }}</td>
                                <td>{{ $new_data->chart_type }}</td>
                            </tr>
                            <tr>
                                <td>ts</td>
                                <td>{{ $old_data->ts_value }}</td>
                                <td>{{ $new_data->ts_value }}</td>
                            </tr>
                            <tr>
                                <td>us</td>
                                <td>{{ $old_data->us_value }}</td>
                                <td>{{ $new_data->us_value }}</td>
                            </tr>
                            <tr>
                                <td>ls</td>
                                <td>{{ $old_data->ls_value }}</td>
                                <td>{{ $new_data->ls_value }}</td>
                            </tr>
                            <tr>
                                <td>tc</td>
                                <td>{{ $old_data->tc_value }}</td>
                                <td>{{ $new_data->tc_value }}</td>
                            </tr>
                            <tr>
                                <td>uc</td>
                                <td>{{ $old_data->uc_value }}</td>
                                <td>{{ $new_data->uc_value }}</td>
                            </tr>
                            <tr>
                                <td>lc</td>
                                <td>{{ $old_data->lc_value }}</td>
                                <td>{{ $new_data->lc_value }}</td>
                            </tr>
                            <tr>
                                <td>Param Unit</td>
                                <td>{{ $old_data->param_unit_name }}</td>
                                <td>{{ $new_data->param_unit_name }}</td>
                            </tr>
                            <tr>
                                <td>tcp</td>
                                <td>{{ $old_data->tcp_value }}</td>
                                <td>{{ $new_data->tcp_value }}</td>
                            </tr>
                            <tr>
                                <td>tcpk</td>
                                <td>{{ $old_data->tcpk_value }}</td>
                                <td>{{ $new_data->tcpk_value }}</td>
                            </tr>
                            <tr>
                                <td>tsd</td>
                                <td>{{ $old_data->tsd_value }}</td>
                                <td>{{ $new_data->tsd_value }}</td>
                            </tr>
                        </tbody>
                    @endif
                </table>
            </div>
            @if (isset($new_data))
                @if ($new_data->status == 1)
                    <div class="complete">
                        <h3 style="color: #15e47c">Status : Approve</h3>
                    </div>
                @elseif($new_data->status == 2)
                    <div class="complete">
                        <h3 style="color: red">Status : Reject</h3>
                    </div>
                @endif
            @endif
            <div class="input_field">
                @error('password')
                    <label class="err_password">*</label>
                @enderror
                <label>Password</label>
                <input type="password" wire:model.live='password'>
            </div>
            <div>
                @if (isset($new_data))
                    <button class="reject_btn" wire:click='reject_update({{ $new_data->id }})'>Reject</button>
                    <button class="approve_btn"
                        wire:click='approve_update({{ $new_data->spec_id }},{{ $new_data->id }})'>Approve</button>
                @endif
            </div>
        </div>
    </div>
    <div class="bg_modal_2" id='modal_insert' wire:ignore.self>
        <div class="modal_content">
            <i class='bx bx-x icon' id="close_insert" wire:click='close_modal'></i>
            <h2>Approve request</h2>
            <label class="label_header">User id number @if (isset($new_data))
                    {{ $new_data->regis_user_id }}
                @endif wants to isert new SPC spec. Do you want to approve it or
                not?</label>
            <div wire:loading wire:target="load_insert" class="loading">
                <div class="loader"></div>
                <label>Loading..</label>
            </div>
            <div class="data_detail">
                <table>
                    <thead>
                        <tr>
                            <th>Column</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    @if (isset($new_data))
                        <tbody>
                            <tr>
                                <td>Process</td>
                                <td>{{ $new_data->process_name }}</td>
                            </tr>
                            <tr>
                                <td>Line</td>
                                <td>{{ $new_data->line_name }}</td>
                            </tr>
                            <tr>
                                <td>Machine</td>
                                <td>{{ $new_data->machine_name }}</td>
                            </tr>
                            <tr>
                                <td>Partname</td>
                                <td>{{ $new_data->partname }}</td>
                            </tr>
                            <tr>
                                <td>Parameter</td>
                                <td>{{ $new_data->param_name }}</td>
                            </tr>
                            <tr>
                                <td>Chart</td>
                                <td>{{ $new_data->chart_type }}</td>
                            </tr>
                            <tr>
                                <td>ts</td>
                                <td>{{ $new_data->ts_value }}</td>
                            </tr>
                            <tr>
                                <td>us</td>
                                <td>{{ $new_data->us_value }}</td>
                            </tr>
                            <tr>
                                <td>ls</td>
                                <td>{{ $new_data->ls_value }}</td>
                            </tr>
                            <tr>
                                <td>tc</td>
                                <td>{{ $new_data->tc_value }}</td>
                            </tr>
                            <tr>
                                <td>uc</td>
                                <td>{{ $new_data->uc_value }}</td>
                            </tr>
                            <tr>
                                <td>lc</td>
                                <td>{{ $new_data->lc_value }}</td>
                            </tr>
                            <tr>
                                <td>Param Unit</td>
                                <td>{{ $new_data->param_unit_name }}</td>
                            </tr>
                            <tr>
                                <td>tcp</td>
                                <td>{{ $new_data->tcp_value }}</td>
                            </tr>
                            <tr>
                                <td>tcpk</td>
                                <td>{{ $new_data->tcpk_value }}</td>
                            </tr>
                            <tr>
                                <td>tsd</td>
                                <td>{{ $new_data->tsd_value }}</td>
                            </tr>
                        </tbody>
                    @endif
                </table>
            </div>
            @if (isset($new_data))
                @if ($new_data->status == 1)
                    <div class="complete">
                        <h3 style="color: #15e47c">Status : Approve</h3>
                    </div>
                @elseif($new_data->status == 2)
                    <div class="complete">
                        <h3 style="color: red">Status : Reject</h3>
                    </div>
                @endif
            @endif
            <div class="input_field">
                @error('password')
                    <label class="err_password">*</label>
                @enderror
                <label>Password</label>
                <input type="password" wire:model.live='password'>
            </div>
            <div>
                @if (isset($new_data))
                    <button class="reject_btn" wire:click='reject_insert({{ $new_data->id }})'>Reject</button>
                    <button class="approve_btn" wire:click='approve_insert({{ $new_data->id }})'>Approve</button>
                @endif
            </div>
        </div>
    </div>
    <div class="bg_modal_3" id='modal_upsert' wire:ignore.self>

        <div class="modal_content">
            <div wire:loading wire:target="load_upsert" class="load_file">
                <div class="loader"></div>
                <label>Loading..</label>
            </div>
            <div wire:loading wire:target='export_up' class="dowload_file">
                <div class="loader"></div>
            </div>
            <i class='bx bx-x icon' id="close_upsert" wire:click='close_modal'></i>
            <h2>Approve request</h2>
            <label class="label_header">If you approve, all old data
                will be replaced.Do you want to approve it or not?</label>
            <div class="file_icon" wire:click='export_up'>
                <i class='bx bx-file-blank'></i>
                <label>Dowload file</label>
            </div>
            <div class="input_field">
                @error('password')
                    <label class="err_password">*</label>
                @enderror
                <label>Password</label>
                <input type="password" wire:model.live='password'>
            </div>
            <div>
                @if (isset($new_data))
                    <button class="reject_btn" wire:click='reject_upsert({{ $new_data->group }})'>Reject</button>
                    <button class="approve_btn" wire:click='approve_upsert({{ $new_data->group }})'>Approve</button>
                @endif
            </div>
        </div>
    </div>
    <div class="bg_modal_4" id='modal_insert_file' wire:ignore.self>
        <div class="modal_content">

            <i class='bx bx-x icon' wire:click='close_modal' id='close_insert_file'></i>
            <h2>Approve request</h2>
            <label class="label_header">User id number @if (isset($new_data))
                    {{ $new_data->regis_user_id }}
                @endif wants to insert new spc spec file. Do you want to approve it
                or not?</label>
            <div wire:loading wire:target='export_in' class="dowload_file">
                <div class="loader"></div>
            </div>
            <div wire:loading wire:target="load_insert_file" class="load_file">
                <div class="loader"></div>
                <label>Loading..</label>
            </div>
            <div class="file_icon" wire:click='export_in'>
                <i class='bx bx-file-blank'></i>
                <label>Dowload file</label>
            </div>

            <div class="input_field">
                @error('password')
                    <label class="err_password">*</label>
                @enderror
                <label>Password</label>
                <input type="password" wire:model.live='password'>
            </div>
            <div>
                @if (isset($new_data))
                    <button class="reject_btn" wire:click='reject_insert_file({{ $new_data->group }})'>Reject</button>
                    <button class="approve_btn"
                        wire:click='approve_insert_file({{ $new_data->group }})'>Approve</button>
                @endif
            </div>
        </div>
    </div>
    <div class="contaion">
        <h1>Approve Request ({{ $all_request }})</h1>
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
                            <tr>
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
                    <div class="update_detail" wire:click='load_update({{ $detail->id }})'>
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
                    <div class="upsert_detail" wire:click='load_upsert({{ $detail->id }})'>
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
                    <div class="insert_file_detail" wire:click='load_insert_file({{ $detail->id }})'>
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
                    <div class="insert_detail" wire:click='load_insert({{ $detail->id }})'>
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
