<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')
    <div class="mt-30px mx-50px">
        <div style="display: flex; justify-content: space-between; width: max-content; font-size: 16px;">
            <div class="action-count">All</div>
            <div>(2) |</div>
            <div class="action-count">Confirmed</div>
            <div>(1) |</div>
            <div class="action-count">Delete</div>
            <div>(1)</div>
        </div>

        <div class="mt-10px action-btn">
            <select>
                <option>Accept</option>
                <option>Reject</option>
            </select>
            <button>Apply</button>
        </div>

        <div class="mt-10px request-list">
            <table>
                <tr>
                    <th class="checkbox_td"><input type="checkbox" id="main_checkbox"></th>
                    <th>Room</th>
                    <th>From</th>
                    <th>To</th>
                    <th>User</th>
                    <th>Accept</th>
                    <th>Reject</th>
                    </th>
                </tr>
                <tr>
                    <td class="checkbox_td"><input class="request-for-booking" type="checkbox"></td>
                    <td>
                        <div>Room #1</div>
                        <div>Seat 67</div>
                    </td>
                    <td>22.01, before lunch</td>
                    <td>22.02, after lunch</td>
                    <td>Name Surname</td>
                    <td><button class="accept-btn">Accept</button></td>
                    <td><button class="reject-btn">Reject</button></td>
                    </td>
                </tr>
                <tr>
                    <td class="checkbox_td"><input class="request-for-booking" type="checkbox"></td>
                    <td>
                        <div>Room #1</div>
                        <div>Seat 67</div>
                    </td>
                    <td>22.01, before lunch</td>
                    <td>22.02, after lunch</td>
                    <td>Name Surname</td>
                    <td><button class="accept-btn">Accept</button></td>
                    <td><button class="reject-btn">Reject</button></td>
                    </td>
                </tr>
                <tr>
                    <td class="checkbox_td"><input class="request-for-booking" type="checkbox"></td>
                    <td>
                        <div>Room #1</div>
                        <div>Seat 67</div>
                    </td>
                    <td>22.01, before lunch</td>
                    <td>22.02, after lunch</td>
                    <td>Name Surname</td>
                    <td><button class="accept-btn">Accept</button></td>
                    <td><button class="reject-btn">Reject</button></td>
                    </td>
                </tr>
            </table>
        </div>

    </div>
@endsection
