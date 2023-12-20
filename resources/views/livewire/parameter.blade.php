<div class="space">
    <div class="contaion">
        <div id="myModal" class="modal" wire:ignore.self>
            <div class="modal-content" id="modal-content">
                @if ($check_edit == 0)
                    <h2>Modify Parameter</h2>
                    <div wire:loading wire:target="modal" class="loading">
                        <div class="loader"></div>
                        <label>Loading..</label>
                    </div>
                    <div class="input_field">
                        <table>
                            <tr>
                                <td>Process</td>
                                <td><input type="text" value="{{ $process }}" wire:model.live='process'></td>
                            </tr>
                            <tr>
                                <td>Line</td>
                                <td><input type="text" value="{{ $line }}" wire:model.live='line'></td>
                            </tr>
                            <tr>
                                <td>Machine</td>
                                <td><input type="text" value="{{ $machine }}" wire:model.live='machine'></td>
                            </tr>
                            <tr>
                                <td>Partname</td>
                                <td><input type="text" value="{{ $partname }}" wire:model.live='partname'></td>
                            </tr>
                            <tr>
                                <td>Parameter</td>
                                <td><input type="text" value="{{ $variable }}" wire:model.live='variable'></td>
                            </tr>
                            <tr>
                                <td>chart</td>
                                <td><input type="text" value="{{ $chart }}" wire:model.live='chart'></td>
                            </tr>
                            <tr>
                                <td>ts</td>
                                <td><input type="number" value="{{ $ts }}" wire:model.live='ts'></td>
                            </tr>
                            <tr>
                                <td>us</td>
                                <td><input type="number" value="{{ $us }}" wire:model.live='us'></td>
                            </tr>
                            <tr>
                                <td>ls</td>
                                <td><input type="number" value="{{ $ls }}" wire:model.live='ls'></td>
                            </tr>
                            <tr>
                                <td>tc</td>
                                <td><input type="number" value="{{ $tc }}" wire:model.live='tc'></td>
                            </tr>
                            <tr>
                                <td>uc</td>
                                <td><input type="number" value="{{ $uc }}" wire:model.live='uc'></td>
                            </tr>
                            <tr>
                                <td>lc</td>
                                <td><input type="number" value="{{ $lc }}" wire:model.live='lc'></td>
                            </tr>
                            <tr>
                                <td>Param Unit</td>
                                <td><input type="text" value="{{ $unit }}" wire:model.live='unit'></td>
                            </tr>
                            <tr>
                                <td>tcp</td>
                                <td><input type="number" value="{{ $tcp }}" wire:model.live='tcp'></td>
                            </tr>
                            <tr>
                                <td>tcpk</td>
                                <td><input type="number" value="{{ $tcpk }}" wire:model.live='tcpk'></td>
                            </tr>
                            <tr>
                                <td>tsd</td>
                                <td><input type="number" value="{{ $tsd }}" wire:model.live='tsd'></td>
                            </tr>
                        </table>
                    </div>
                    <div class="error_input">
                        <label>{{ $message }}</label>
                    </div>
                @else
                    <div wire:loading wire:target="save_change" class="loading_save">
                        <div class="loader_save"></div>
                    </div>
                    <div class="body">
                        <div class="header">
                            <i class='bx bxs-check-circle'></i>
                            <h2>Saved Changes</h2>
                        </div>
                        <div class="parag">
                            <label>If data is saved, old data will be replaced. Do you confirm to save the new
                                data?</label>
                        </div>
                    </div>
                    <table>
                        <tr>
                            <td>Employee id</td>
                            <td><input type="text" wire:model='check_id'></td>
                            <td>
                                @error('check_id')
                                    <div class="error_confirm">*</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" wire:model='check_password'></td>
                            <td>
                                @error('check_password')
                                    <div class="error_confirm">*</div>
                                @enderror
                            </td>
                        </tr>
                    </table>
                @endif
                <div class="footermodal">
                    <button class="close_btn" id="close_btn_1" wire:click='cancel'>Close</button>
                    @if ($check_edit == 0)
                        <button class="save_btn" id='save_btn' wire:click='save_edit'>Save changes</button>
                    @else
                        <button class="confirm_btn" wire:click='save_change'>Confirm</button>
                    @endif
                </div>
            </div>
        </div>

        <div id="insert_modal" class="modal" wire:ignore.self>
            <div class="modal-content" id="insert">
                @if ($check_edit == 0)
                    <h2>Add Parameter</h2>
                    <div wire:loading wire:target="add_parameter" class="loading">
                        <div class="loader"></div>
                        <label>Loading..</label>
                    </div>
                    <div class="input_field_register">
                        <table>
                            <tr>
                                <td> @error('process')
                                        <div class="err_parameter">*</div>
                                    @enderror
                                    <label>Process</label>
                                </td>
                                <td><input type="text" wire:model.live='process'>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @error('line')
                                        <div class="err_parameter">*</div>
                                    @enderror
                                    <label>Line</label>
                                </td>
                                <td><input type="text" wire:model.live='line'></td>
                            </tr>
                            <tr>

                                <td>
                                    @error('machine')
                                        <div class="err_parameter">*</div>
                                    @enderror
                                    <label>Machine</label>
                                </td>
                                <td><input type="text" wire:model.live='machine'></td>
                            </tr>
                            <tr>
                                <td>
                                    @error('partname')
                                        <div class="err_parameter">*</div>
                                    @enderror
                                    <label>Partname</label>
                                </td>
                                <td><input type="text" wire:model.live='partname'></td>
                            </tr>
                            <tr>
                                <td>
                                    @error('variable')
                                        <div class="err_parameter">*</div>
                                    @enderror
                                    <label>Parameter</label>
                                </td>
                                <td><input type="text" wire:model.live='variable'></td>
                            </tr>
                            <tr>
                                <td>
                                    @error('chart')
                                        <div class="err_parameter">*</div>
                                    @enderror
                                    <label>chart</label>
                                </td>
                                <td><input type="text" wire:model.live='chart'></td>
                            </tr>
                            <tr>
                                <td>
                                    @error('ts')
                                        <div class="err_parameter">*</div>
                                    @enderror
                                    <label>ts</label>
                                </td>
                                <td><input type="number" wire:model.live='ts'></td>
                            </tr>
                            <tr>
                                <td>
                                    @error('us')
                                        <div class="err_parameter">*</div>
                                    @enderror
                                    <label>us</label>
                                </td>
                                <td><input type="number" wire:model.live='us'></td>
                            </tr>
                            <tr>
                                <td>
                                    @error('ls')
                                        <div class="err_parameter">*</div>
                                    @enderror
                                    <label>ls</label>
                                </td>
                                <td><input type="number" wire:model.live='ls'></td>
                            </tr>
                            <tr>
                                <td>
                                    @error('tc')
                                        <div class="err_parameter">*</div>
                                    @enderror
                                    <label>tc</label>
                                </td>
                                <td><input type="number" wire:model.live='tc'></td>
                            </tr>
                            <tr>
                                <td>
                                    @error('uc')
                                        <div class="err_parameter">*</div>
                                    @enderror
                                    <label>uc</label>
                                </td>
                                <td><input type="number" wire:model.live='uc'></td>
                            </tr>
                            <tr>
                                <td>
                                    @error('lc')
                                        <div class="err_parameter">*</div>
                                    @enderror
                                    <label>lc</label>
                                </td>
                                <td><input type="number" wire:model.live='lc'></td>
                            </tr>
                            <tr>
                                <td>
                                    @error('unit')
                                        <div class="err_parameter">*</div>
                                    @enderror
                                    <label>Param Unit</label>
                                </td>
                                <td><input type="text" wire:model.live='unit'></td>
                            </tr>
                            <tr>
                                <td>
                                    @error('tcp')
                                        <div class="err_parameter">*</div>
                                    @enderror
                                    <label>tcp</label>
                                </td>
                                <td><input type="number" wire:model.live='tcp'></td>
                            </tr>
                            <tr>
                                <td>
                                    @error('tcpk')
                                        <div class="err_parameter">*</div>
                                    @enderror
                                    <label>tcpk<label></label>
                                </td>
                                <td><input type="number" wire:model.live='tcpk'></td>
                            </tr>
                            <tr>
                                <td>
                                    @error('tsd')
                                        <div class="err_parameter">*</div>
                                    @enderror
                                    <label>tsd</label>
                                </td>
                                <td><input type="number" wire:model.live='tsd'></td>
                            </tr>
                        </table>
                    </div>
                @else
                    <div wire:loading wire:target="register_spec" class="loading_save">
                        <div class="loader_save"></div>
                    </div>
                    <div class="body">
                        <div class="header">
                            <i class='bx bxs-check-circle'></i>
                            <h2>Saved new data</h2>
                        </div>
                        <div class="parag">
                            <label>Do you confirm to save this information?</label>
                        </div>
                    </div>
                    <table>
                        <tr>
                            <td>Employee id</td>
                            <td><input type="text" wire:model='check_id'></td>
                            <td>
                                @error('check_id')
                                    <div class="error_confirm">*</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" wire:model='check_password'></td>
                            <td>
                                @error('check_password')
                                    <div class="error_confirm">*</div>
                                @enderror
                            </td>
                        </tr>
                    </table>
                @endif
                <div class="footermodal">
                    <button class="close_btn" id='close_btn_2' wire:click='cancel'>Close</button>
                    @if ($check_edit == 0)
                        <button class="save_btn" id='register' wire:click='register'>Register</button>
                    @else
                        <button class="confirm_btn" wire:click='register_spec'>Confirm</button>
                    @endif
                </div>
            </div>
        </div>

        <div id="upload_modal" class="modal" wire:ignore.self>
            <div class="upload_file">
                @if ($check_edit == 0)
                    <h2>Add File</h2>
                    @error('file')
                        <div class="file_err">{{ $message }}</div>
                    @enderror
                    <input type='file' wire:model="file" required>
                    @error('action')
                        <div class="action_err">{{ $message }}</div>
                    @enderror
                    <div class="action_menu close">
                        <label class="header">Action</label>
                        <div class="menu_header">
                            <label>
                                @if ($action == 1)
                                    Insert Spec
                                @elseif($action == 2)
                                    Upsert Spec
                                @else
                                    Select . . .
                                @endif
                            </label>
                        </div>
                        <i class='bx bx-chevron-down icon'></i>
                        <div class="list_menu">
                            <ul>
                                <li wire:click='change_action(1)'>Insert Spec</li>
                                <li wire:click='change_action(2)'>Upsert Spec</li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div wire:loading wire:target="insert_file" class="loading_save">
                        <div class="loader_save"></div>
                    </div>
                    <div class="body">
                        <div class="header">
                            <i class='bx bxs-check-circle'></i>
                            <h2>Saved file</h2>
                        </div>
                        <div class="parag">
                            <label>Do you confirm to save this information?</label>
                        </div>
                    </div>
                    <div class="table_center">
                        <table>
                            <tr>
                                <td>Employee id</td>
                                <td><input type="text" wire:model='check_id'></td>
                                <td>
                                    @error('check_id')
                                        <div class="error_confirm">*</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input type="password" wire:model='check_password'></td>
                                <td>
                                    @error('check_password')
                                        <div class="error_confirm">*</div>
                                    @enderror
                                </td>
                            </tr>
                        </table>
                    </div>

                @endif
                <div class="footermodal">
                    <button class="close_btn" id="close_btn_3" wire:click='cancel'>Cancel</button>
                    @if ($check_edit == 0)
                        <button class="add_btn" id="add_btn" wire:click='add_file'>Add</button>
                    @else
                        <button class="save_file" wire:click='insert_file'>Confirm</button>
                    @endif
                </div>
                <div wire:loading wire:target="file">
                    <div class="loader"></div>
                </div>
            </div>
        </div>

        <h1>Register Parameter</h1>
        <div class="header topbar">
            <div class="dropdown close">
                <label>Show {{ $rows }} rows</label>
                <i class='bx bx-chevron-down'></i>
                <div class="list_rows">
                    <ul>
                        <li wire:click='change_r(10)'>10</li>
                        <li wire:click='change_r(25)'>25</li>
                        <li wire:click='change_r(50)'>50</li>
                        <li wire:click='change_r(100)'>100</li>
                    </ul>
                </div>
            </div>
            <button class="button" id="insert_btn" wire:click='add_parameter'>
                <i class='bx bx-plus icon'></i>
                <div class="text">Add Parameter</div>
            </button>
            <button class="button" id='upload_btn'><i class='bx bx-upload icon'></i>
                <div class="text">Upload File</div>
            </button>
            <button class="button" wire:click='export'><i class='bx bxs-file-export icon'></i>
                <div class="text">Export All (CSV)</div>
            </button>
            <div wire:loading wire:target="export" class="loading_page"></div>
            <div class="search_field">
                <label>Search</label>
                <input type="text" wire:model.live='search_text' placeholder="Search..">
            </div>
        </div>
        <div class="card_space">
            @if (count($param) == 0)
                <div class="not_found">
                    <img src="/assets/image/not_found.jpg">
                    <h2>Not Found</h2>
                </div>
            @endif
            <?php
            $index = 1;
            ?>
            @foreach ($param as $value)
                <div class="card" wire:click='modal({{ $value->id }})'>
                    <div class="row">
                        <div class="head_row">
                            <label>ID</label>
                        </div>
                        <div class="body_row">
                            <label>: {{ $index }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="head_row">
                            <label>Process</label>
                        </div>
                        <div class="body_row">
                            <label>: {{ $value->process_name }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="head_row">
                            <label>Line</label>
                        </div>
                        <div class="body_row">
                            <label>: {{ $value->line_name }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="head_row">
                            <label>Machine</label>
                        </div>
                        <div class="body_row">
                            <label>: {{ $value->machine_name }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="head_row">
                            <label>Partname</label>
                        </div>
                        <div class="body_row">
                            <label>: {{ $value->partname }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="head_row">
                            <label>Parameter</label>
                        </div>
                        <div class="body_row">
                            <label>: {{ $value->param_name }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="head_row">
                            <label>Chart</label>
                        </div>
                        <div class="body_row">
                            <label>: {{ $value->chart_type }}</label>
                        </div>
                    </div>
                </div>
                <?php
                $index += 1;
                ?>
            @endforeach

        </div>
        <div class="table_space">
            <table class="parameter">
                <thead class="header">
                    <tr>
                        <th>id</th>
                        <th>Process</th>
                        <th>Line</th>
                        <th>Machine</th>
                        <th>Partname</th>
                        <th>Parameter</th>
                        <th>Chart</th>
                        <th>ts</th>
                        <th>us</th>
                        <th>ls</th>
                        <th>tc</th>
                        <th>uc</th>
                        <th>lc</th>
                        <th>Param Unit</th>
                        <th>tcp</th>
                        <th>tcpk</th>
                        <th>tsd</th>
                    </tr>
                </thead>
                <tbody class="body" id='myBtn'>
                    <?php
                    $index = $parameter->firstItem();
                    ?>
                    @foreach ($parameter as $param)
                        <tr wire:click='modal({{ $param->id }})'>
                            <td class="id">{{ $index }}</td>
                            <td>{{ $param->process_name }}</td>
                            <td>{{ $param->line_name }}</td>
                            <td>{{ $param->machine_name }}</td>
                            <td>{{ $param->partname }}</td>
                            <td>{{ $param->param_name }}</td>
                            <td>{{ $param->chart_type }}</td>
                            <td>{{ $param->ts_value }}</td>
                            <td>{{ $param->us_value }}</td>
                            <td>{{ $param->ls_value }}</td>
                            <td>{{ $param->tc_value }}</td>
                            <td>{{ $param->uc_value }}</td>
                            <td>{{ $param->lc_value }}</td>
                            <td>{{ $param->param_unit_name }}</td>
                            <td>{{ $param->tcp_value }}</td>
                            <td>{{ $param->tcpk_value }}</td>
                            <td>{{ $param->tsd_value }}</td>
                        </tr>
                        <?php
                        $index += 1;
                        ?>
                    @endforeach
                </tbody>
            </table>
            @if (count($parameter) == 0)
                <div class="not_found">
                    <img src="/assets/image/not_found.jpg">
                    <h2>Not Found</h2>
                </div>
            @endif

            <div class="footer">
                <label class="show_page">Showing {{ $parameter->firstItem() }} to {{ $parameter->lastItem() }} of
                    {{ $parameter->total() }}</label>
                <div>
                    @if ($parameter->currentPage() == 1)
                        <label class="previous_close">Previous</label>
                    @else
                        <a href='{{ $parameter->previousPageUrl() }}' class="previous">Previous</a>
                    @endif
                    @for ($index = 1; $index <= $parameter->lastPage(); $index++)
                        @if ($parameter->lastPage() <= 7)
                            <a href="/spc/parameter?page={{ $index }}" class="index">{{ $index }}</a>
                        @else
                            @if ($parameter->currentPage() <= 4)
                                @if ($index <= 5 || $index == $parameter->lastPage())
                                    <a href="/spc/parameter?page={{ $index }}"
                                        class="index">{{ $index }}</a>
                                @endif
                                @if ($index == $parameter->lastPage() - 1)
                                    <label>. . .</label>
                                @endif
                            @elseif($parameter->currentPage() >= $parameter->lastPage() - 3)
                                @if ($index == 1 || $index >= $parameter->lastPage() - 4)
                                    <a href="/spc/parameter?page={{ $index }}"
                                        class="index">{{ $index }}</a>
                                @endif
                                @if ($index == 2)
                                    <label>. . .</label>
                                @endif
                            @else
                                @if (
                                    $index == 1 ||
                                        $index == $parameter->lastPage() ||
                                        $index == $parameter->currentPage() ||
                                        $index == $parameter->currentPage() + 1 ||
                                        $index == $parameter->currentPage() - 1)
                                    <a href="/spc/parameter?page={{ $index }}"
                                        class="index">{{ $index }}</a>
                                @endif
                                @if ($index == $parameter->lastPage() - 1 || $index == 2)
                                    <label>. . .</label>
                                @endif
                            @endif
                        @endif
                    @endfor
                    @if ($parameter->currentPage() == $parameter->lastPage())
                        <label class="next_close">Next</label>
                    @else
                        <a href='{{ $parameter->nextPageUrl() }}' class="next">Next</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
