type User = {
    id: string;
    name: string;
    lastname: string;
};

const users: User[] = [];
export const db = {
    user: {
        findMany: async () => users,
        findById: async (id: string) => users.find((user) => user.id === id),
        create: async (data: { name: string; lastname: string; }) => {
            const user = { id: String(users.length + 1), ...data };
            users.push(user);
            return user;
        },
    },
};
