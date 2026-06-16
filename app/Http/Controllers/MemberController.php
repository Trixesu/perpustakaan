<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:members',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        Member::create($request->validated());
        return redirect()->route('members.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:members,email,' . $member->id,
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $member->update($request->validated());
        return redirect()->route('members.index')->with('success', 'Anggota berhasil diupdate!');
    }

    public function destroy(Member $member)
    {
        if ($member->loans()->where('status', 'borrowed')->exists()) {
            return redirect()->back()->with('error', 'Anggota masih memiliki peminjaman aktif, tidak bisa dihapus!');
        }
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Anggota berhasil dihapus!');
    }
}
