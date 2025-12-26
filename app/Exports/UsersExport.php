<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class UsersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }
    public function collection()
    {
        return collect($this->users);
    }

    /**
     * @var User $user
     */
   public function map($user): array
    {
        return [
            $user->id,
            $user->first_name,
            $user->middle_name,
            $user->last_name,
            $user->email,
            $user->role,
            date('Y-m-d H:i:s', strtotime($user->created_at)),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'First Name',
            'Middle Name',
            'Last Name',
            'Email',
            'Role',
            'Created At',
        ];
    }

   public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Make row 1 (headings) bold
        ];
    }
}