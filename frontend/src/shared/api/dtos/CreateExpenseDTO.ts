export interface CreateExpenseDTO {
  description: string;
  date: Date | null;
  value: string;
  user_id: number
}