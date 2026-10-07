<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Myth\Auth\Models\UserModel;

class Users extends BaseController
{
    protected $db;
    protected $userModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $builder = $this->db->table('users');
        $builder->select('users.id, users.username, users.email, users.active, users.created_at, auth_groups.name as group_name, auth_groups.description as group_desc, auth_groups.id as group_id');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id', 'left');
        $builder->where('users.deleted_at', null);
        $builder->orderBy('users.id', 'ASC');
        $users = $builder->get()->getResultObject();

        $groups = $this->db->table('auth_groups')->get()->getResultObject();

        $data = [
            'title' => 'Manajemen User',
            'users' => $users,
            'groups' => $groups,
        ];

        return view('user/index', $data);
    }

    public function new()
    {
        $groups = $this->db->table('auth_groups')->get()->getResultObject();
        $data = [
            'title'  => 'Tambah User Baru',
            'groups' => $groups,
        ];

        return view('user/new', $data);
    }

    public function store()
    {
        $rules = [
            'username'     => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required|min_length[8]',
            'pass_confirm' => 'required|matches[password]',
            'group_id'     => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = new \Myth\Auth\Entities\User([
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'active'   => $this->request->getPost('active') ? 1 : 0,
        ]);

        if (!$this->userModel->save($user)) {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }

        $userId = $this->userModel->getInsertID();
        $groupId = $this->request->getPost('group_id');

        if ($groupId && $userId) {
            $this->db->table('auth_groups_users')->insert([
                'group_id' => $groupId,
                'user_id'  => $userId,
            ]);
        }

        return redirect()->to(site_url('users'))->with('success', 'User baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $builder = $this->db->table('users');
        $builder->select('users.id, users.username, users.email, users.active, auth_groups.name as group_name, auth_groups.id as group_id');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id', 'left');
        $builder->where('users.id', $id);
        $user = $builder->get()->getRowObject();

        if (!$user) {
            return redirect()->to(site_url('users'))->with('error', 'User tidak ditemukan.');
        }

        $groups = $this->db->table('auth_groups')->get()->getResultObject();

        $data = [
            'title' => 'Edit User',
            'user' => $user,
            'groups' => $groups,
        ];

        return view('user/edit', $data);
    }

    public function update($id)
    {
        $group_id = $this->request->getPost('group_id');
        $active   = $this->request->getPost('active') ? 1 : 0;

        // Update active status
        $this->db->table('users')->where('id', $id)->update(['active' => $active]);

        // Update group
        if ($group_id) {
            $this->db->table('auth_groups_users')->where('user_id', $id)->delete();
            $this->db->table('auth_groups_users')->insert([
                'group_id' => $group_id,
                'user_id'  => $id,
            ]);
        }

        return redirect()->to(site_url('users'))->with('success', 'Data user berhasil diperbarui.');
    }

    public function toggle($id)
    {
        $user = $this->db->table('users')->where('id', $id)->get()->getRowObject();
        if ($user) {
            $newStatus = $user->active ? 0 : 1;
            $this->db->table('users')->where('id', $id)->update(['active' => $newStatus]);
            $msg = $newStatus ? 'User berhasil diaktifkan.' : 'User berhasil dinonaktifkan.';
            return redirect()->to(site_url('users'))->with('success', $msg);
        }
        return redirect()->to(site_url('users'))->with('error', 'User tidak ditemukan.');
    }

    public function delete($id)
    {
        // Prevent deleting currently logged in admin user
        if (user_id() == $id) {
            return redirect()->to(site_url('users'))->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $this->db->table('auth_groups_users')->where('user_id', $id)->delete();
        $this->db->table('users')->where('id', $id)->delete();

        return redirect()->to(site_url('users'))->with('success', 'User berhasil dihapus.');
    }
}
